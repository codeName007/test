<?php

$dbh = new PDO('mysql:dbname=test;host=127.0.0.1', 'root');
$sql = '
    create table if not exists indexCheck (
        id int auto_increment,
        str char(32),
        field1 tinyint,
        field2 tinyint,
        primary key (id),
        key field1 (field1)
    );
';
$sth = $dbh->prepare($sql);
$sth->execute();
$i = 0;
while ($i < 1000) {
    $i++;
    $field = mt_rand(0, 1);
    $sth = $dbh->prepare('insert into indexCheck values (null, md5(rand(32)), :field1, :field2)');
    $sth->bindParam(':field1', $field, PDO::PARAM_INT);
    $sth->bindParam(':field2', $field, PDO::PARAM_INT);
    $sth->execute();
}
/*
explain select count(*) from indexCheck where field1 = 1;
+----+-------------+------------+------+---------------+--------+---------+-------+------+--------------------------+
| id | select_type | table      | type | possible_keys | key    | key_len | ref   | rows | Extra                    |
+----+-------------+------------+------+---------------+--------+---------+-------+------+--------------------------+
|  1 | SIMPLE      | indexCheck | ref  | field1        | field1 | 2       | const |  507 | Using where; Using index |
+----+-------------+------------+------+---------------+--------+---------+-------+------+--------------------------+
explain select count(*) from indexCheck where field2 = 1;
+----+-------------+------------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table      | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+------------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | indexCheck | ALL  | NULL          | NULL | NULL    | NULL | 1165 | Using where |
+----+-------------+------------+------+---------------+------+---------+------+------+-------------+

select count(*) from indexCheck where field1 = 1;
+----------+
| count(*) |
+----------+
|      507 |
+----------+
1 row in set (0.00 sec)

select count(*) from indexCheck where field2 = 1;
+----------+
| count(*) |
+----------+
|      507 |
+----------+
1 row in set (0.00 sec) - !!!!!
*/
