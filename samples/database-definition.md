 テーブル定義書 

<!--
        body {
            font-family: NotoSansJP, Noto Sans JP, sans-serif;
        }

        hr {
            border: solid 1px #cccccc;
            margin: 20px 0;
        }

        th {
            border: solid 1px;
            padding: 10px;
            background-color: #cccccc;
            text-align: center;
        }

        td {
            border: solid 1px;
            padding: 10px;
            background-color: #ffffff;
            text-align: left;
        }

        table {
            border-collapse: collapse;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

 -->
 # <a id="top">Tables</a>



 | \# | Table Name | Comment |
|---|---|---|
| 1 | [failed\_jobs](#failed_jobs) |  |
| 2 | [migrations](#migrations) |  |
| 3 | [password\_resets](#password_resets) |  |
| 4 | [personal\_access\_tokens](#personal_access_tokens) |  |
| 5 | [users](#users) |  |



---

## <a id="failed_jobs">failed\_jobs</a>

 

### Table Information

 | RDBMS | dd\_dev\_db |
|---|---|
| Table Name | failed\_jobs |
| Options | Engine: InnoDB    Collation: utf8mb4\_unicode\_ci    Charset: utf8mb4    Comment: |



### Columns Information

 | \# | COLUMN | TYPE | Length | UNSIGNED | PRIMARY KEY | FOREIGN KEY | AUTOINCREMENT | NOT NULL | DEFAULT | COMMENT |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | id | bigint |  |  | ◯ |  | ◯ | ◯ | - |  |
| 2 | uuid | string | 255 |  |  |  |  | ◯ | - |  |
| 3 | connection | text | 65535 |  |  |  |  | ◯ | - |  |
| 4 | queue | text | 65535 |  |  |  |  | ◯ | - |  |
| 5 | payload | text |  |  |  |  |  | ◯ | - |  |
| 6 | exception | text |  |  |  |  |  | ◯ | - |  |
| 7 | failed\_at | datetime |  |  |  |  |  | ◯ | CURRENT\_TIMESTAMP |  |



### Indexes Information

 | \# | INDEX NAME | COLUMNS | UNIQUE |
|---|---|---|---|
| 1 | PRIMARY | id | ◯ |
| 2 | failed\_jobs\_uuid\_unique | uuid | ◯ |



 [top](#top) 

---

## <a id="migrations">migrations</a>

 

### Table Information

 | RDBMS | dd\_dev\_db |
|---|---|
| Table Name | migrations |
| Options | Engine: InnoDB    Collation: utf8mb4\_unicode\_ci    Charset: utf8mb4    Comment: |



### Columns Information

 | \# | COLUMN | TYPE | Length | UNSIGNED | PRIMARY KEY | FOREIGN KEY | AUTOINCREMENT | NOT NULL | DEFAULT | COMMENT |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | id | integer |  |  | ◯ |  | ◯ | ◯ | - |  |
| 2 | migration | string | 255 |  |  |  |  | ◯ | - |  |
| 3 | batch | integer |  |  |  |  |  | ◯ | - |  |



### Indexes Information

 | \# | INDEX NAME | COLUMNS | UNIQUE |
|---|---|---|---|
| 1 | PRIMARY | id | ◯ |



 [top](#top) 

---

## <a id="password_resets">password\_resets</a>

 

### Table Information

 | RDBMS | dd\_dev\_db |
|---|---|
| Table Name | password\_resets |
| Options | Engine: InnoDB    Collation: utf8mb4\_unicode\_ci    Charset: utf8mb4    Comment: |



### Columns Information

 | \# | COLUMN | TYPE | Length | UNSIGNED | PRIMARY KEY | FOREIGN KEY | AUTOINCREMENT | NOT NULL | DEFAULT | COMMENT |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | email | string | 255 |  |  |  |  | ◯ | - |  |
| 2 | token | string | 255 |  |  |  |  | ◯ | - |  |
| 3 | created\_at | datetime |  |  |  |  |  |  | - |  |



### Indexes Information

 | \# | INDEX NAME | COLUMNS | UNIQUE |
|---|---|---|---|
| 1 | password\_resets\_email\_index | email |  |



 [top](#top) 

---

## <a id="personal_access_tokens">personal\_access\_tokens</a>

 

### Table Information

 | RDBMS | dd\_dev\_db |
|---|---|
| Table Name | personal\_access\_tokens |
| Options | Engine: InnoDB    Collation: utf8mb4\_unicode\_ci    Charset: utf8mb4    Comment: |



### Columns Information

 | \# | COLUMN | TYPE | Length | UNSIGNED | PRIMARY KEY | FOREIGN KEY | AUTOINCREMENT | NOT NULL | DEFAULT | COMMENT |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | id | bigint |  |  | ◯ |  | ◯ | ◯ | - |  |
| 2 | tokenable\_type | string | 255 |  |  |  |  | ◯ | - |  |
| 3 | tokenable\_id | bigint |  |  |  |  |  | ◯ | - |  |
| 4 | name | string | 255 |  |  |  |  | ◯ | - |  |
| 5 | token | string | 64 |  |  |  |  | ◯ | - |  |
| 6 | abilities | text | 65535 |  |  |  |  |  | - |  |
| 7 | last\_used\_at | datetime |  |  |  |  |  |  | - |  |
| 8 | created\_at | datetime |  |  |  |  |  |  | - |  |
| 9 | updated\_at | datetime |  |  |  |  |  |  | - |  |



### Indexes Information

 | \# | INDEX NAME | COLUMNS | UNIQUE |
|---|---|---|---|
| 1 | personal\_access\_tokens\_tokenable\_type\_tokenable\_id\_index | tokenable\_type , tokenable\_id |  |
| 2 | PRIMARY | id | ◯ |
| 3 | personal\_access\_tokens\_token\_unique | token | ◯ |



 [top](#top) 

---

## <a id="users">users</a>

 

### Table Information

 | RDBMS | dd\_dev\_db |
|---|---|
| Table Name | users |
| Options | Engine: InnoDB    Collation: utf8mb4\_unicode\_ci    Charset: utf8mb4    Comment: |



### Columns Information

 | \# | COLUMN | TYPE | Length | UNSIGNED | PRIMARY KEY | FOREIGN KEY | AUTOINCREMENT | NOT NULL | DEFAULT | COMMENT |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | id | bigint |  |  | ◯ |  | ◯ | ◯ | - |  |
| 2 | name | string | 255 |  |  |  |  | ◯ | - |  |
| 3 | email | string | 255 |  |  |  |  | ◯ | - |  |
| 4 | email\_verified\_at | datetime |  |  |  |  |  |  | - |  |
| 5 | password | string | 255 |  |  |  |  | ◯ | - |  |
| 6 | remember\_token | string | 100 |  |  |  |  |  | - |  |
| 7 | created\_at | datetime |  |  |  |  |  |  | - |  |
| 8 | updated\_at | datetime |  |  |  |  |  |  | - |  |



### Indexes Information

 | \# | INDEX NAME | COLUMNS | UNIQUE |
|---|---|---|---|
| 1 | PRIMARY | id | ◯ |
| 2 | users\_email\_unique | email | ◯ |



 [top](#top) 

---

 published at: 2022-06-14 10:13:56