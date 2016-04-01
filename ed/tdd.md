TDD
-

````
Stub    - an object that provides predefined answers to method calls.
Mock    - an object on which you set expectations.
Fixture - is the fixed state that exists at the start of a test.
````

<ul>
    <li><b>Acceptance</b>: Does the whole system work?</li>
    <li><b>Integration</b>: Does our code work against code we can't change?</li>
    <li><b>Unit</b>: Do our objects do the right thing, are they convenient to work with?</li>
</ul>

Tests should act as documentation for the code.

Each test should have just one assert.
But better rule is to think of one coherent feature per test,
which might be represented by up to a handful of assertions.
And better writing tests where each method exercises a unique aspect of the target code’s behavior.

All code should emphasize "what" it does over "how", including test code;

A common technique to isolate tests that use a transactional resource (such as a database)
is to run each test in a transaction which is then rolled back at the end of the test.
The problem with this technique is that it doesn’t test what happens on commit, which is a significant event.
The ORM flushes the state of the objects it is managing in memory to the database.
The database, in turn, checks its integrity constraints.
A test that never commits does not fully exercise how the code under test interacts with the database.