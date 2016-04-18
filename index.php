<?php

?>
<html><body><pre>

 1. DB Schema
   http://115.29.38.239/myadmin/index.php?db=tan&token=13892ed348fba62028b299050610595f

 2. API List
 
     (1) employee register himself to db : register.php
            url:http://115.29.38.239/treat/register.php
	        input param: name,phone
            DB:    employee
	        Return eid(employee_id)
			 
	(2) query customer made by himself: query_customer.php 
		    url:http://115.29.38.239/treat/query_customer.php
			input: eid(employee_id)
			DB: customer
			return customers' info
			
	(3) add customer info 
	        url:http://115.29.38.239/treat/add_customer.php
			input: name,phone,sex,age,address,comment,eid
			DB: customer
			return cid

        (4) create treatment for customer:create_treat.php
            url:http://115.29.38.239/treat/create_treat.php
            (input param: cid, eid,start,end)
             savetodb:  treatment
             return tid)
       
        (5) query treatment info made by him
            url:http://115.29.38.239/treat/query_treat.php
            (input param:tid(treatment_id)
             queryDB: employee,customer,treatment)
             

        (5) employee to gerenate barcode
	     input param: id(treat_id)
             db: treatment, treatment_record;
             return: 3 barcode string)

        (6) Scan barcode to get info
            input param: barcode string
            db: treatment, treament_record, customer,employee
            return: customer info,epmloyee info, treatment info, treatment history)

        (4) update treat status
            input param: treatment id, treamtment_status
            db: treatment_record
	    return: ok/fail
          
</pre></body></html>
