class Foo:

    def __init__(self):
        print('init')

    def __post_init__(self):
        print('postinit')


Foo()
