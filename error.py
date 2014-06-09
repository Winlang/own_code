# try:
# 	print 'try...'
# 	r = 10/1  #r=10/0    
# 	print 'result:',r
# except ZeroDivisionError,e:
# 	print 'except:',e
# finally:
# 	#print 'finally...'
# 	r = 10/0
# print 'END'





# def foo(s):
# 	return 10/int(s)

# def bar(s):
# 	return foo(s)*2

# def main():
# 	try:
# 		bar('0')
# 	except StandardError,e:
# 		print 'Error!'
# 	finally:
# 		print 'finally...'

# main()





# def foo(s):
# 	return 10/int(s)

# def bar(s):
# 	return foo(s)*2

# def main():
# 	bar('0')
# main()



import logging

def foo(s):
	return 10/int(s)

def bar(s):
	return foo(s)*2

def main():
	try:
		bar('0')
	except StandardError,e:
		logging.exception(e)
main()
print 'END'