# class Fib(object):
# 	def __init__(self):
# 		self.a,self.b=0,1 
	
# 	def __iter__(self):	
# 		return self
	
# 	def next(self):
# 		self.a,self.b=self.b,self.a+self.b
# 		if self.a>1000:
# 			raise StopIteration();
# 		return self.a

# for n in Fib():
# 	print n



# def fib(n):
# 	result = []
# 	a,b = 0,1
# 	n = int(raw_input('please enter the top of the list'))
# 	while b < n:
# 		result.append(b)
# 		a,b = b,a+b
# 	return result

# print fib(100)


class Fib(object):
	def __getitem__(self,n):
		a,b=1,1
		for x in range(n):
			a,b=b,a+b
		return a

f=Fib()
print f[2]