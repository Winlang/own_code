#def fact(n):
#	return fact_iter(1,1,n)
#
#def fact_iter(product,count,max):
#	if count > max:
#		return product
#	return fact_iter(product * count,count + 1,max)	
#
#print fact(5)


#class Student(object):
#	@property
#	def score(self):
#		return self.__score
#
#	@score.setter
#	def score(self,value):
#		if not isinstance(value,int):
#			raise ValueError('score must be an integer!')
#		if value <0 or value >100:
#			raise ValueError('score must between 0~100')
#		self.__score = value
#
#s = Student()
#s.score = 60
#print s.score

class Student(object):
	def __init__(self,name):
		self.name = name
	
	def __str__(self):
		return 'Student object(name:%s)'%self.name
	
print Student('rowen')
