// Cypher



// NODES
CREATE (n:Person {name:'James Bond', code:'007', active:true}) RETURN n;
CREATE (n:Person {name:'Moneypenny', code:'mp', active:true}) RETURN n;
CREATE (n:Person {name:'Felix Leiter', code:'felix'});
CREATE (n:Person {name:'008', code:'008'}) RETURN n;
CREATE (n:Person {name:'Q', code: 'q'});
CREATE (n:Person {name:'M', code: 'm'});

CREATE (n:Organization {name:'MI6'});
CREATE (n:Organization {name:'CIA'});
CREATE (n:Organization {name:'test'});

CREATE (n:Country {name:'UK'});
CREATE (n:Country {name:'USA'});

// RELATIONSHIPS
// works at
MATCH (p:Person), (o:Organization) WHERE p.code = '007'   AND o.name = 'MI6' CREATE (p)-[r:WORKS_AT]->(o);
MATCH (p:Person), (o:Organization) WHERE p.code = '008'   AND o.name = 'MI6' CREATE (p)-[r:WORKS_AT]->(o);
MATCH (p:Person), (o:Organization) WHERE p.code = 'mp'    AND o.name = 'MI6' CREATE (p)-[r:WORKS_AT]->(o);
MATCH (p:Person), (o:Organization) WHERE p.code = 'q'     AND o.name = 'MI6' CREATE (p)-[r:WORKS_AT]->(o);
MATCH (p:Person), (o:Organization) WHERE p.code = 'm'     AND o.name = 'MI6' CREATE (p)-[r:WORKS_AT]->(o);
MATCH (p:Person), (o:Organization) WHERE p.code = 'felix' AND o.name = 'CIA' CREATE (p)-[r:WORKS_AT]->(o);
// bond familiar with
MATCH (a:Person), (b:Person) WHERE a.code = '007' AND b.code = 'mp'    CREATE (a)-[r:FAMILIAR]->(b) RETURN type(r);
MATCH (a:Person), (b:Person) WHERE a.code = '007' AND b.code = 'felix' CREATE (a)-[r:FAMILIAR]->(b);
MATCH (a:Person), (b:Person) WHERE a.code = '007' AND b.code = '008'   CREATE (a)-[r:FAMILIAR]->(b);
MATCH (a:Person), (b:Person) WHERE a.code = '007' AND b.code = 'q'     CREATE (a)-[r:FAMILIAR]->(b);
MATCH (a:Person), (b:Person) WHERE a.code = '007' AND b.code = 'm'     CREATE (a)-[r:FAMILIAR]->(b);
// country of organization
MATCH (o:Organization {name: 'MI6'}),(c:Country {name:'UK'}) CREATE (o)-[r:COUNTRY]->(c) RETURN o, c;
MATCH (o:Organization {name: 'CIA'}),(c:Country {name:'USA'}) CREATE (o)-[r:COUNTRY]->(c) RETURN o, c;



// get all
MATCH (n:Person) RETURN n;
MATCH (n:Organization) RETURN n;
MATCH (c:Country) MATCH (o:Organization) MATCH (p:Person) RETURN c, o, p;

// get
MATCH (n:Person {code:'007'}) RETURN n;
MATCH (p:Person) WHERE p.code = '007'  RETURN p;
MATCH (p:Person) WHERE p.code STARTS WITH '00'  RETURN p;
MATCH (p:Person) WHERE NOT p.code STARTS WITH '00'  RETURN p;
MATCH (n:Organization {name:'test'}) RETURN n;
MATCH (n:Person) WHERE n.active = true RETURN n;

// get 2
MATCH (p:Person {code:'007'})
MATCH (o:Organization {name:'MI6'})
RETURN p, o;

// update
MATCH (n:Organization {name:'test'}) SET n.name = 'TEST_ORG' RETURN n.name;
MATCH (n:Organization {name:'TEST_ORG'}) RETURN n;

// delete
MATCH (n:Person {name:'James Bond'}) DELETE n;
MATCH (n:Organization {name:'test'}) DELETE n;
MATCH (n:Organization {name:'TEST_ORG'}) DELETE n;
// delete relationship
MATCH (p:Person {code: 'felix'})-[r:WORKS_AT]->(o:Organization) DELETE r;

// select all
MATCH (n) RETURN n SKIP 0 LIMIT 100;
MATCH (n:Organization) RETURN n;

// with
MATCH (p:Person {code:'007'})--(relatedTo)-->()
WITH relatedTo
RETURN relatedTo.name;

// with 2
MATCH (bond:Person {code:'007'})
WITH bond
MATCH (bond)-[:WORKS_AT]->(o:Organization)-[:COUNTRY]->(c:Country {name:'UK'})
RETURN bond, o, c;



// wisited
MATCH (p:Person {code: '007'}),(c:Country {name:'USA'}) CREATE (p)-[r:WISITED]->(c) RETURN p, c;

// node's relationships
MATCH (:Person {code: '007'})-[r]-() RETURN r;
MATCH (:Organization {name: 'MI6'})-[r]-() RETURN r;

// bond familiar with
MATCH (b:Person {code: '007'})-[:FAMILIAR]->(n) RETURN b, n.name ORDER BY n.name;

// bond works at
MATCH (b:Person {code: '007'})-[:WORKS_AT]->(n) RETURN b, n.name ORDER BY n.name;

// country of MI6
MATCH (:Organization {name: 'MI6'})-[:COUNTRY]->(c) RETURN c;

// country for persons
MATCH (p:Person)-[:WORKS_AT]->(o)-[:COUNTRY]->(c) RETURN p, o, c;
MATCH (p:Person)-[]->()-[]->(c:Country) RETURN p, c;

// active person or from CIA
MATCH (c1:Country)<-[:COUNTRY]-(o1:Organization)<-[:WORKS_AT]-(p1:Person {active: true})
MATCH (c2:Country)<-[:COUNTRY]-(o2:Organization {name: 'CIA'})<-[:WORKS_AT]-(p2:Person)
RETURN c1, o1, p1, c2, o2, p2;

//
MATCH (a:Person)-[*2]->(b:Country) RETURN a, b;





// AGGREGATION
MATCH (n:Person) RETURN COUNT(n) as count;
MATCH (n:Person) RETURN DISTINCT LABELS(n), COUNT(*);
MATCH (n:Person) RETURN DISTINCT n.code;