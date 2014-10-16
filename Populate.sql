INSERT INTO suppliers_t (contact_num, address, name) VALUES(09328545780,"Manila","Scry Enterprises");

INSERT INTO suppliers_t (contact_num, address, name) VALUES(12345672,"Quezon City"," Quezon Providence");

INSERT INTO suppliers_t (contact_num, address, name) VALUES(7432626,"Quezon City","Chaser");


INSERT INTO parts_t (part_name, part_detail, price, qty) VALUES("Model 3425 Head Lamp","for Mitsubishi, color yellow",250,3);

INSERT INTO parts_t (part_name, part_detail, price, qty) VALUES("Model 6243 Bumper X","for honda, silver encrusted",1000,1);

INSERT INTO parts_t (part_name, part_detail, price, qty) VALUES("Nuvo Brake Pad","SUV",250,10);


INSERT INTO SUPPLIED_PARTS(supplier_id, part_id) VALUES(1,3);

INSERT INTO SUPPLIED_PARTS(supplier_id, part_id) VALUES(2,3);

INSERT INTO SUPPLIED_PARTS(supplier_id, part_id) VALUES(3,3);

INSERT INTO SUPPLIED_PARTS(supplier_id, part_id) VALUES(1,2);

INSERT INTO SUPPLIED_PARTS(supplier_id, part_id) VALUES(3,1);


INSERT INTO customers_t(contact_num, address, name) VALUES(12312312312,"Marikina","Scaryka");

INSERT INTO customers_t(contact_num, address, name) VALUES(12312312312,"Makati","Lance");

INSERT INTO invoices_t(customer_id,invoice_date,status) VALUES(1,'2014-10-13',"Pending");

INSERT INTO invoices_t(customer_id,invoice_date,status) VALUES(1,'2014-9-13',"Complete");

INSERT INTO invoices_t(customer_id,invoice_date,status) VALUES(2,'2013-10-29',"Cancelled");


INSERT INTO invoice_histories_t(invoice_id, part_id, qty, current_price) VALUES(1,1,1, 200);

INSERT INTO invoice_histories_t(invoice_id, part_id, qty, current_price) VALUES(1,2,1, 200);

INSERT INTO invoice_histories_t(invoice_id, part_id, qty, current_price) VALUES(2,3,2, 1500);

INSERT INTO invoice_histories_t(invoice_id, part_id, qty, current_price) VALUES(3,3,3, 900);



INSERT INTO stock_orders_t(date_ordered, status) VALUES('2013-10-29',"Complete");

INSERT INTO stock_orders_t(date_ordered, status) VALUES('2014-10-13',"Cancelled");


INSERT INTO STOCK_ORDER_HISTORIES(part_id, supplier_id, stock_order_id, current_price, qty) VALUES(1,3, 1, 200, 3);

INSERT INTO STOCK_ORDER_HISTORIES(part_id, supplier_id, stock_order_id, current_price, qty) VALUES(2,3,1 ,100, 2 );

INSERT INTO STOCK_ORDER_HISTORIES(part_id, supplier_id, stock_order_id, current_price, qty) VALUES(3,1,2, 150, 2);


INSERT INTO users_t(username, password, admin) VALUES("Scry","scry", 1);

INSERT INTO users_t(username, password, admin) VALUES("Employee","scry", 0);
