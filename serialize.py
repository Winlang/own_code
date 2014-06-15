#pickle

# try:
#  	import cPickle as pickle
# except ImportError:
#  	import pickle

# d = dict(name='Bob',age=20,score=88)
# f = open('text.txt','wb')
# pickle.dump(d,f)
# f.close()
#print pickle.dumps(d)

# f = open('text.txt','rb')
# d = pickle.load(f)
# f.close()
# print d 


#Json

import json
# d = dict(name='bob',age=20,score=88)
# print json.dumps(d)

json_str = '{"age":20,"score":88,"name":"Bob"}'
print json.loads(json_str)