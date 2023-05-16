ALTER TABLE offices
ADD CONSTRAINT offices_unique UNIQUE (name);

ALTER TABLE brands
ADD CONSTRAINT brands_unique UNIQUE (name);

ALTER TABLE products
ADD CONSTRAINT products_unique UNIQUE (name);
