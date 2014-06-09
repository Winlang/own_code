# class Hello(object):
# 	def hello(self,name='world'):
# 		print('hello %s.'%name)

# h = Hello()
# h.hello()


def fn(self,name='world'):
	print('Hello,%s . '%name)

Hello = type('Hello',(object,),dict(hello=fn))

h = Hello()
h.hello()
#this is a test
