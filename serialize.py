try:
 	import cPickle as pickle
except ImportError:
 	import pickle

d = dict(name='Bob',age=20,score=88)
print pickle.dumps(d)