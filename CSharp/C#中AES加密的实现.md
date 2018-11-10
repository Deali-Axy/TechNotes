## AES算法简介
![image.png](https://upload-images.jianshu.io/upload_images/8869373-b51911ad33beec87.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
>**高级加密标准**（英语：**A**dvanced **E**ncryption **S**tandard，[缩写](https://zh.wikipedia.org/wiki/%E7%BC%A9%E5%86%99 "缩写")：AES），在[密码学](https://zh.wikipedia.org/wiki/%E5%AF%86%E7%A0%81%E5%AD%A6 "密码学")中又称**Rijndael加密法**，是[美国联邦政府](https://zh.wikipedia.org/wiki/%E7%BE%8E%E5%9B%BD%E8%81%94%E9%82%A6%E6%94%BF%E5%BA%9C "美国联邦政府")采用的一种[区块加密](https://zh.wikipedia.org/wiki/%E5%8D%80%E5%A1%8A%E5%8A%A0%E5%AF%86 "区块加密")标准。这个标准用来替代原先的[DES](https://zh.wikipedia.org/wiki/DES "DES")，已经被多方分析且广为全世界所使用。经过五年的甄选流程，高级加密标准由[美国国家标准与技术研究院](https://zh.wikipedia.org/wiki/%E7%BE%8E%E5%9B%BD%E5%9B%BD%E5%AE%B6%E6%A0%87%E5%87%86%E4%B8%8E%E6%8A%80%E6%9C%AF%E7%A0%94%E7%A9%B6%E9%99%A2 "美国国家标准与技术研究院")（NIST）于2001年11月26日发布于FIPS PUB 197，并在2002年5月26日成为有效的标准。2006年，高级加密标准已然成为[对称密钥加密](https://zh.wikipedia.org/wiki/%E5%AF%B9%E7%A7%B0%E5%AF%86%E9%92%A5%E5%8A%A0%E5%AF%86 "对称密钥加密")中最流行的[算法](https://zh.wikipedia.org/wiki/%E6%BC%94%E7%AE%97%E6%B3%95 "算法")之一。
>
>该算法为[比利时](https://zh.wikipedia.org/wiki/%E6%AF%94%E5%88%A9%E6%97%B6 "比利时")密码学家Joan Daemen和Vincent Rijmen所设计，结合两位作者的名字，以Rijndael为名投稿高级加密标准的甄选流程。（Rijndael的发音近于"Rhine doll"）

## AES加密过程
AES加密过程是在一个4×4的[字节](https://zh.wikipedia.org/wiki/%E5%AD%97%E8%8A%82 "字节")矩阵上运作，这个矩阵又称为“体（state）”，其初值就是一个明文区块（矩阵中一个元素大小就是明文区块中的一个Byte）。（Rijndael加密法因支持更大的区块，其矩阵行数可视情况增加）加密时，各轮AES加密循环（除最后一轮外）均包含4个步骤：

1.  `AddRoundKey`—矩阵中的每一个字节都与该次[回合密钥](https://zh.wikipedia.org/w/index.php?title=%E5%9B%9E%E5%90%88%E9%87%91%E9%91%B0&action=edit&redlink=1 "回合密钥（页面不存在）")（round key）做[XOR运算](https://zh.wikipedia.org/wiki/XOR "XOR")；每个子密钥由密钥生成方案产生。
2.  `SubBytes`—通过一个非线性的替换函数，用[查找表](https://zh.wikipedia.org/wiki/%E6%9F%A5%E6%89%BE%E8%A1%A8 "查找表")的方式把每个字节替换成对应的字节。
3.  `ShiftRows`—将矩阵中的每个横列进行循环式移位。
4.  `MixColumns`—为了充分混合矩阵中各个直行的操作。这个步骤使用线性转换来混合每内联的四个字节。最后一个加密循环中省略`MixColumns`步骤，而以另一个`AddRoundKey`取代。

## C#代码实现
定义默认密钥向量   
```c#
private static byte[] _aesKetByte = { 0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF, 0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF };
private static string _aesKeyStr = Encoding.UTF8.GetString(_aesKetByte);
```

随机生成密钥
```C#
public static byte[] GetIv(int n)
{
	char[] arrChar = new char[]{
	   'a','b','d','c','e','f','g','h','i','j','k','l','m','n','p','r','q','s','t','u','v','w','z','y','x',
	   '0','1','2','3','4','5','6','7','8','9',
	   'A','B','C','D','E','F','G','H','I','J','K','L','M','N','Q','P','R','T','S','V','U','W','X','Y','Z'
	};

	StringBuilder num = new StringBuilder();

	Random rnd = new Random(DateTime.Now.Millisecond);
	for (int i = 0; i < n; i++)
	{
		num.Append(arrChar[rnd.Next(0, arrChar.Length)].ToString());
	}

	_aesKetByte = Encoding.UTF8.GetBytes(num.ToString());
	return _aesKetByte;
}
```

**AES加密**
```c#
/// <summary>
/// AES加密
/// </summary>
/// <param name="Data">被加密的明文</param>
/// <param name="Key">密钥</param>
/// <param name="Vector">向量</param>
/// <returns>密文</returns>
public static String AESEncrypt(String Data, String Key, String Vector)
{
	Byte[] plainBytes = Encoding.UTF8.GetBytes(Data);

	Byte[] bKey = new Byte[32];
	Array.Copy(Encoding.UTF8.GetBytes(Key.PadRight(bKey.Length)), bKey, bKey.Length);
	Byte[] bVector = new Byte[16];
	Array.Copy(Encoding.UTF8.GetBytes(Vector.PadRight(bVector.Length)), bVector, bVector.Length);

	Byte[] Cryptograph = null; // 加密后的密文

	Rijndael Aes = Rijndael.Create();
	try
	{
		// 开辟一块内存流
		using (MemoryStream Memory = new MemoryStream())
		{
			// 把内存流对象包装成加密流对象
			using (CryptoStream Encryptor = new CryptoStream(Memory,
			Aes.CreateEncryptor(bKey, bVector),
			CryptoStreamMode.Write))
			{
				// 明文数据写入加密流
				Encryptor.Write(plainBytes, 0, plainBytes.Length);
				Encryptor.FlushFinalBlock();

				Cryptograph = Memory.ToArray();
			}
		}
	}
	catch
	{
		Cryptograph = null;
	}

	return Convert.ToBase64String(Cryptograph);
}
```

**AES解密**
```c#
/// <summary>
/// AES解密
/// </summary>
/// <param name="Data">被解密的密文</param>
/// <param name="Key">密钥</param>
/// <param name="Vector">向量</param>
/// <returns>明文</returns>
public static String AESDecrypt(String Data, String Key, String Vector)
{
	Byte[] encryptedBytes = Convert.FromBase64String(Data);
	Byte[] bKey = new Byte[32];
	Array.Copy(Encoding.UTF8.GetBytes(Key.PadRight(bKey.Length)), bKey, bKey.Length);
	Byte[] bVector = new Byte[16];
	Array.Copy(Encoding.UTF8.GetBytes(Vector.PadRight(bVector.Length)), bVector, bVector.Length);

	Byte[] original = null; // 解密后的明文

	Rijndael Aes = Rijndael.Create();
	try
	{
		// 开辟一块内存流，存储密文
		using (MemoryStream Memory = new MemoryStream(encryptedBytes))
		{
			// 把内存流对象包装成加密流对象
			using (CryptoStream Decryptor = new CryptoStream(Memory,
			Aes.CreateDecryptor(bKey, bVector),
			CryptoStreamMode.Read))
			{
				// 明文存储区
				using (MemoryStream originalMemory = new MemoryStream())
				{
					Byte[] Buffer = new Byte[1024];
					Int32 readBytes = 0;
					while ((readBytes = Decryptor.Read(Buffer, 0, Buffer.Length)) > 0)
					{
						originalMemory.Write(Buffer, 0, readBytes);
					}

					original = originalMemory.ToArray();
				}
			}
		}
	}
	catch
	{
		original = null;
	}
	return Encoding.UTF8.GetString(original);
}
```

使用默认向量加解密
```c#
/// <summary>
/// AES加密(无向量)
/// </summary>
/// <param name="Data">被加密的明文</param>
/// <param name="Key">密钥</param>
/// <returns>密文</returns>
public static string AESEncrypt(String Data, String Key)
{
	return AESEncrypt(Data, Key, _aesKeyStr);

}
/// <summary>
/// AES解密(无向量)
/// </summary>
/// <param name="Data">被加密的明文</param>
/// <param name="Key">密钥</param>
/// <returns>明文</returns>
public static string AESDecrypt(String Data, String Key)
{
	return AESDecrypt(Data, Key, _aesKeyStr);
}
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------

了解更多有趣的操作请关注我的微信公众号：DealiAxy

每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)

