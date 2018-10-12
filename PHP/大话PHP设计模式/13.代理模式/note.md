## 代理模式
1. 在客户端与实体之间建立一个代理对象（proxy），客户端对实体进行操作全部委派给代理对象，
隐藏实体的具体实现细节。

2. Proxy还可以与业务代码分离，部署到另外的服务器。业务代码中通过RPC来委派任务。

## 代理模式与父类和接口的异同
- 相同点:代理模式的作用和父类以及接口和组合的作用类似,都是为了聚合共用部分,减少公共部分的代码
- 不同点:
	- 相比起父类,他们的语境不同,父类要表达的含义是 is-a, 而代理要表达的含义更接近于接口, 是 has-a,而且使用代理的话应了一句话"少用继承,多用组合",要表达的意思其实也就是降低耦合度了
	- 相比起接口,他们实现的功能又不太一样,语境都是has-a,不过接口是has-a-function,而代理对象时是has-a-object,这个object是has-a-function的object,此外,接口是为了说明这个类拥有什么功能,却没有具体实现,实现了多态,而代理对象不但拥有这个功能,还拥有这个功能的具体实现
	- 对于组合来说，他比组合更具灵活性，比如我们将代理对象设为private，那么我可以选择只提供一部分的代理功能，例如Printer的某一个或两个方法，又或者在提供Printer的功能的时候加入一些其他的操作，这些都是可以的
	
## 实现代码
```php
class Printer {    //代理对象,一台打印机
	public function printSth() {
		echo 'I can print <br>';
	}
	
	// some more function below
	// ...
}
 
class TextShop {    //这是一个文印处理店,只文印,卖纸,不照相
	private $printer;
	
	public function __construct(Printer $printer) {
		$this->printer = $printer;
	}
	
	public function sellPaper() {    //卖纸
		echo 'give you some paper <br>';
	}
	
	public function __call($method, $args) {    //将代理对象有的功能交给代理对象处理
		if(method_exists($this->printer, $method)) {
			$this->printer->$method($args);
		}
	}
}
 
class PhotoShop {    //这是一个照相店,只文印,拍照,不卖纸
	private $printer;
	
	public function __construct(Printer $printer) {
		$this->printer = $printer;
	}
	
	public function takePhotos() {    //照相
		echo 'take photos for you <br>';
	}
	
	public function __call($method, $args) {    //将代理对象有的功能交给代理对象处理
		if(method_exists($this->printer, $method)) {
			$this->printer->$method($args);
		}
	}
}

$printer = new Printer();
$textShop = new TextShop($printer);
$photoShop = new PhotoShop($printer);

$textShop->printSth();
$photoShop->printSth();
```

文印处理店和照相店都具有文印的功能,所以我们可以将文印的功能代理给一台打印机,这里打印机只有一个功能,假如打印机还有n个功能,我们使用`__call()`方法就能够省去很多重复的代码了

假如是使用继承,这样语境上就不合理,一个店显然不应该继承一台打印机

而使用接口,因为我们的功能实现都是一样,也没有必要去重新实现接口的功能

所以此处使用代理是最佳选择

Java中的代理模式实现其实类似,只不过Java没有__call()方法,需要手动声明printSth()方法,然后在方法体里去调用$printer的printSth()方法
或者可以用`InvocationHandler`代理接口来实现代理，
```java
public interface InvocationHandler { 
   public Object invoke(Object proxy, Method method, Object[] args) throw Throwable; 
}

//日志代理实现   
public class LogHandler implement InvocationHandler{ 

   private Object target; 

   public LogHandler(Object target){ 
       this.target = target; 
   } 
   public Object invoke(Object proxy, Method method, Object[] args ) throw Throwable{ 

       //记录函数的初始状况参数等信息 
       log4j.info(“开始:方法”+ method.getName() + “参数”+Arrays.toString(args) );

       Object result = method.invoke(target, args); 

       //记录函数的执行状况与返回值 
       log4j.info(“结束:方法”+ method.getName() + “返回值”+ result ); 

   }
}

//主函数   
public class Main{ 
   public static void main(String[ ] args){ 
	   //例子中生成报告的功能，生成报告需要记录日志。
       ReportGenerator reportGeneratorImpl  = new SMSReportGenerator (); 

       //通过系统提供的Proxy.newProxyInstance创建动态代理实例 
       ReportGenerator reportGenerator = (ReportGenerator ) Proxy.newProxyInstance(  
           reportGeneratorImpl.getClass().getClassLoader(), 
           reportGeneratorImpl.getClass().getInterfaces(), 
           new LogHandler(reportGeneratorImpl)
       ) ; 
       ...
   }
}
```

但是 Java Reflection API 实现的动态代理结构十分复杂，不易理解，此处就不再赘述了