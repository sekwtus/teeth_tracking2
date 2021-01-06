{{-- UPDATE customer
INNER JOIN customer_PC ON customer.CustomerCodePC = customer_PC.CustomerCode
SET customer.CustomerName = customer_PC.CustomerName,
    customer.CustomerAddress = customer_PC.CustomerAddress,
		customer.CustomerVisitor = customer_PC.CustomerVisitor,
		customer.CustomerAccNo = customer_PC.CustomerAccNo,
		customer.CustomerTransport = customer_PC.CustomerTransport,
		customer.CustomerCredit = customer_PC.CustomerCredit,
		customer.CustomerLimitMoney = customer_PC.CustomerLimitMoney,
		customer.CustomerTel1 = customer_PC.CustomerTel1,
		customer.CustomerTel2 = customer_PC.CustomerTel2,
		customer.CustomerTaxID = customer_PC.CustomerTaxID --}}
