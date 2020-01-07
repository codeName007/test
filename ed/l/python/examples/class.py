class Student0:
  pass

class Student1:
  @staticmethod
  def f3():
    print("static")

class Student:
  classProperty = "foo"
  def __init__(self): # initializer
    print("construct")
  def f(self, v):
    print("Got:",v)
    Student1.f3()

class Student2(Student, Student0): # Student2 extends Student & Student0
  def f2(self, v):
    super().f(v)

student = Student2()
student.f2(100)
