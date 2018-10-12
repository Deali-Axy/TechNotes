def status(func):
    print('慌的一逼！')
    return func
@status
def name():
    print('我是梅西！')

    
name()