
CREATE database IF NOT EXISTS scry;
USE scry;

CREATE TABLE IF NOT EXISTS suppliers_t(
supplier_id INTEGER(100) AUTO_INCREMENT NOT NULL,
contact_num INTEGER(12) NOT NULL,
address VARCHAR(255) NOT NULL,
name VARCHAR(255) NOT NULL,
CONSTRAINT suppliers_pk PRIMARY KEY (supplier_id)
);

CREATE TABLE IF NOT EXISTS parts_t(
part_id INTEGER(100) AUTO_INCREMENT NOT NULL,
part_detail VARCHAR(255) NOT NULL,
price FLOAT(10,2) NOT NULL,
qty INTEGER(10) NOT NULL,
CONSTRAINT parts_pk PRIMARY KEY (part_id)
);

CREATE TABLE IF NOT EXISTS supplied_parts(
supplier_id INTEGER(100) NOT NULL,
part_id INTEGER(100) NOT NULL,
CONSTRAINT FOREIGN KEY (supplier_id) REFERENCES suppliers_t(supplier_id),
CONSTRAINT FOREIGN KEY (part_id) REFERENCES parts_t(part_id) 
);

CREATE TABLE IF NOT EXISTS customers_t(
customer_id INTEGER(100) AUTO_INCREMENT NOT NULL,
contact_num INTEGER(12) NOT NULL,
address VARCHAR(255) NOT NULL,
name VARCHAR(255) NOT NULL,
CONSTRAINT customers_pk PRIMARY KEY (customer_id)
);
CREATE TABLE IF NOT EXISTS invoices_t(
invoice_id INTEGER (100) AUTO_INCREMENT NOT NULL,
customer_id INTEGER (100) NOT NULL,
invoice_date DATE NOT NULL,
status VARCHAR(20) NOT NULL,
CONSTRAINT invoices_pk PRIMARY KEY(invoice_id),
CONSTRAINT FOREIGN KEY (customer_id) REFERENCES customers_t(customer_id)
);
CREATE TABLE IF NOT EXISTS invoice_histories_t(
invoice_id INTEGER (100) NOT NULL,
part_id INTEGER (100) NOT NULL,
qty INTEGER(10) NOT NULL,
current_price FLOAT(10,2) NOT NULL,
CONSTRAINT FOREIGN KEY (part_id) REFERENCES parts_t(part_id),
CONSTRAINT FOREIGN KEY (invoice_id) REFERENCES invoices_t(invoice_id)
);

CREATE TABLE IF NOT EXISTS stock_orders_t(
stock_order_id INTEGER(100) AUTO_INCREMENT NOT NULL,
date_ordered DATE NOT NULL,
status VARCHAR(20) NOT NULL,
); 
CREATE TABLE IF NOT EXISTS STOCK_ORDER_HISTORIES(
part_id INTEGER(100) NOT NULL,
supplier_id INTEGER(100) NOT NULL,
stock_order_id INTEGER(100) NOT NULL,
current_price FLOAT(10,2) NOT NULL,
qty INTEGER (10) NOT NULL,
CONSTRAINT FOREIGN KEY (part_id) REFERENCES parts_t(part_id),
CONSTRAINT FOREIGN KEY (supplier_id) REFERENCES suppliers_t(supplier_id),
CONSTRAINT FOREIGN KEY (stock_order_id) REFERENCES stock_orders_t(stock_order_id)
);






