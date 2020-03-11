<?php
$config = array (
		//签名方式,默认为RSA2(RSA2048)
		'sign_type' => "RSA2",

		//支付宝公钥
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAskMxLGD/ZWkN7fW0IGrY5io++89FPeiGCi1J/qesEl8VEleaJMINlJA+lI034qP9oZi3UNdhuYY+AgOFW7HjgUjFD6/LJLrwNkV1X+pqJ3aPAAwz4sgWDBqKvELHISTXXTJejS1DeGzotdPoRgeBEdM37PcqnqGjm4/aWKjYZvzvBCko8i42tuFDmfx8WsfMMJUSdFYXGCdkRp1L84PiiPqCj2ODtN9lbTDNW/j/8dZO4bKELcpeeg5uUHB/xopn6Kksqj2g4SZXJ1Ulnzlm3RCN8f6kh2v49+SgwgqIJcMJTxbIgLTw4kB7plz1zhybOYQ9aTAPsU412dYwWJqCewIDAQAB",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAkyl61h/kzruTtLWsmPznB+maqHkKzSAF2wNmDdJxnk5psn9joBF7/gLiOoGvvV7Fup/m5HThKFUIayXBCd6TytrisGOJET/iry1BKJpT9CXxe6IumUzFOVHGmWzX7OGoaJ0jOdGXL8b3CNdZjnF2jFFava5J/4Oie8ejcW+XCUB8O0W/GfxNufTy+S9tgLo0oCsmLz5HVLyzTdobwThe9dCxzVKpTLgjhUU3EeXUlUjNr/+RhOrMCDRCa+ysSftupMoHfaD28DPaJyOjxr0uKgqnjpzV7qZsYpKADNo2kKp1biD4L+seUHxnJXX/flvxUX39Wed3R5EH62J4KVWu/QIDAQABAoIBADvzuxo+lg1ut4b4OF9/MHO1xI77+N2GPTxzTwE0iZsPoNnaMfEFDnl2HUnuiXThhjY4bG0H/K5crfhQwirOJXGP6KgpdK61UxlAm3n6HVeqmY1fjhJgBz0Jxpm8kN7tM5mi4rXsX+ZT7VIJwW9ZZA1YG1qJBZZ1vx0kQL620lYu8SYhHCJZ82utV9AydTYAUPI9I7a3CHkQXqn0rnGpop9Za65B33udN4Bmr1FS3E/TgIOKEbk3ZoxoeUVQIvFBS3eN7zQdw9e/gBlp88GSnAJagniIbtJ+sI7W6wEZYl52GCLMi+TMhtw4xb5ydSLOQMt41nmVSTR/lGZz2R9d7vUCgYEA6tnhWDkagl/az35ubIQOc164UHBkzxUJfU0C9NbGxYl2ckTdkfYcB61b459rwOe/5vieBvWXhit/QOlbrhLToDsM87szUFdAbiJwq7/ZzrK8mlrlKbY9GFuthDGLW5Fxru7SlfuMuB+kCOy9mObXKg6hplRK0DUaI7iDf4aFyLcCgYEAoGoRM3YOn0ccG+2jo+1rm/OZiLk2xbtGyckoTd68Tybf8EdT7W61UMPq+lUuw4C9WyDd4XnJ4iKihcif7eRsuu5QLLyZUQ3+LAbAIc7Zp4D78rCUBQ6tjIuaQ1tlOHwuv/MPYaA+VsP5BEy4QFdg2E/bQceWR0RkpUx1wKNICesCgYEA0DcLyyQVlLFXVc9KJ3uNNEwuLWL4fYCxQR4eGOSypkARe44Cw33nrAbPCSg2aHkPcr/Jm3HyPUojMHG0jsiyR8US3qSCAiDZRsvSCPO3L8LX5CHiOvEPiaD+Xc1vOGfi2q1ylvbG9BdZX3BFSGKhMPB38PeavK3X1wOn0lB6HFECgYEAlw6KmB0p888wpxQGrs1aMgcYo2lWLKkIJehpLbr7NMX0xv1ECSfhUebMFWO1n6BRr8ipaDQZafsXdEfSYmBiCz1y/k2zSmKU4LySnMN+rn+FwamKGaESyHCFmbws+x3loBewekw9p9LvYZ8lOmGN7uR0IeNinkXHSOlRUU/w/HUCgYEA2YsQMlvQT2LOWjqybELGwvzPN8ZE1XMdnx2iM/SrZUJgUaovOpZWj9/37Cbs2X0lwt9Ja9Hf/XpFpm116KLZUZY3BrtAyxorfRA4ydErt9BvhZZfTmGm1XL+BNIo+IONPR1b2oHvk6NGd4u9WbwWj+JqT0OJeqrRePORe8oy9Bw=",

		//编码格式
		'charset' => "UTF-8",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//应用ID
		'app_id' => "2019042964328489",

		//异步通知地址,只有扫码支付预下单可用
		'notify_url' => "https://www.tinygroup.cn/pay/alipay",

		//最大查询重试次数
		'MaxQueryRetry' => "10",

		//查询间隔
		'QueryDuration' => "3"
);