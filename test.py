def fact(n):
	return fact_iter(1,1,n)

def fact_iter(product,count,max):
	if count > max:
		return product
	return fact_iter(product * count,count + 1,max)	

print fact(5)