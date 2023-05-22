create table if not exists db_version(
	db_id	int not null,
	name	varchar(20) not null,
	descr	varchar(255) not null,
	primary key(db_id)
);

INSERT INTO db_version
(db_id,name,descr)
VALUES
(1,'database version 0.1','added db_version table and added unique for some table params to avoid data duplication')
;

ALTER TABLE offices
ADD CONSTRAINT offices_unique UNIQUE (name);

ALTER TABLE brands
ADD CONSTRAINT brands_unique UNIQUE (name);

ALTER TABLE products
ADD CONSTRAINT products_unique UNIQUE (name);
