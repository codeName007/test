Phalcon
-

2.0.9

````php
$di = \Phalcon\DI::getDefault();
$this->getDI()->getShared('config')->get('admin_module')->get('version')
````

#### Controller

````
$this->request->getQuery(); // $_GET
$this->request->getPost(); // $_POST
$this->request->getQuery('_GET');
$this->request->getPost('_POST');
````

#### Devtools

````
# generate model from db table
phalcon model languages --get-set --namespace=W3\\Ziipr\\Models\\v1

# create db migration
phalcon migration --action=generate --table=template --no-auto-increment

# run db migration
phalcon migration --action=run --table=template --version=1.0.0
````