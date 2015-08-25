--create sequence event_no_seq;

create sequence event_seq;

create table event (
    --id integer not null default nextval('event_seq'),
    id integer not null, -- call in code -> nextval('event_seq'),
    event_no varchar(26) not null,
    about varchar(200) not null,
    purpose varchar(50),
    attach varchar(50),
    toward varchar(60),
    department varchar(12),
    division_code varchar(6),
    source integer, -- 0: from supplier, 1: from yogya
    template_code varchar(10),
    first_signature varchar(20),
    second_signature varchar(20),
    approved_by varchar(20),
    approved_date date,
    notes varchar(255),
    cc varchar(100),
    created_by varchar(20),
    created_date date,
    updated_by varchar(20),
    updated_date date
);

alter table event add primary key (id);
alter table event add letter_date date;

create table event_item (
    event_id integer not null,
    tillcode varchar(13),
    category_code varchar(6),
    notes varchar(50),
    supp_code varchar(10),
    yds_responsibility real,
    supp_responsibility real,
    is_pkp integer, -- 0/1
    tax real,
    brutto_margin real,
    net_margin real,
    same_location integer, -- 0/1
    same_date integer -- 0/1
);

create index event_item_idx on event_item(event_id);
create index event_item_idx2 on event_item(tillcode);
create index event_item_idx3 on event_item(category_code);


create table event_location (
    event_id integer not null,
    tillcode varchar(13),
    store_code varchar(5),
    location_code varchar(5)
);

create index event_location_idx on event_location(event_id);
create index event_location_idx2 on event_location(tillcode);

create table event_date (
    event_id integer not null,
    tillcode varchar(13),
    date_start date,
    date_end date -- leave null for single date
);

create index event_date_idx on event_date(event_id);
create index event_date_idx2 on event_date(tillcode);

create table event_same_location (
    event_id integer not null,
    store_code varchar(5),
    location_code varchar(5)
);

create index event_same_location_idx on event_same_location(event_id);

create table event_same_date (
    event_id integer not null,
    date_start date,
    date_end date -- leave null for single date
);

create index event_same_date_idx on event_same_date(event_id);
alter table event_same_date add foreign key(event_id) references event(id);

-- masters

create table mst_template (
    tmpl_code varchar(10),
    tmpl_name varchar(100),
    header text,
    footer text,
    notes text,
    is_active integer, -- 0/1
    created_by varchar(20),
    created_date date,
    updated_by varchar(20),
    updated_date date
);

alter table mst_template add primary key (tmpl_code);

create table mst_supplier (
    supp_code varchar(10) not null,
    supp_desc varchar(60),
    com_ctr varchar(10),
    address varchar(100),
    city varchar(30),
    phone varchar(16),
    fax varchar(16),
    contact_person varchar(30),
    top integer,
    start_date date,
    end_date date,
    is_active integer, -- 0/1
    created_date date
);

alter table mst_supplier add primary key (supp_code);

create table mst_brand (
    brand_code varchar(10) not null,
    brand_desc varchar(60),
    start_date date,
    end_date date,
    is_active integer, -- 0/1
    created_date date
);

alter table mst_brand add primary key (brand_code);

create table mst_store (
    store_code varchar(10) not null,
    store_init varchar(10),
    store_desc varchar(60),
    address varchar(100),
    city varchar(30),
    zipcode varchar(5),
    regional_code varchar(10),
    is_active integer, -- 0/1
    created_date date
);

alter table mst_store add primary key (store_code);

create table mst_division (
    division_code varchar(6),
    division_desc varchar(60),
    is_active integer, -- 0/1
    created_date date
);

alter table mst_division add primary key (division_code);

create table mst_category (
    category_code varchar(6),
    category_desc varchar(60),
    division_code varchar(6),
    is_active integer, -- 0/1
    created_date date
);

alter table mst_category add primary key (category_code);
alter table mst_category add foreign key(division_code) references mst_division(division_code);

create table mst_tillcode (
    tillcode varchar(13),
    disc_label varchar(60),
    disc1 real,
    disc2 real,
    special_price numeric(18, 2),
    division_code varchar(6),
    brand_code varchar(10),
    is_sp integer default 0, -- 0/1
    is_active integer, -- 0/1
    created_date date
);

alter table mst_tillcode add primary key (tillcode);
alter table mst_tillcode add foreign key(division_code) references mst_division(division_code);
alter table mst_tillcode add foreign key(brand_code) references mst_brand(brand_code);
alter table mst_tillcode add article_code varchar(13);
create index mst_tillcode_idx on mst_tillcode(article_code);

create table mst_location (
    loc_code varchar(5),
    loc_desc varchar(30),
    is_active integer, -- 0/1
    created_by varchar(20),
    created_date date,
    updated_by varchar(20),
    updated_date date
);

alter table mst_location add primary key (loc_code);

--alter sequence event_seq owned by event.id;
alter table event add foreign key(division_code) references mst_division(division_code);
alter table event add foreign key(template_code) references mst_template(tmpl_code);
alter table event add is_manual_setting integer default 0; -- 0/1


alter table event_item add foreign key(event_id) references event(id);
alter table event_item add foreign key(tillcode) references mst_tillcode(tillcode);
alter table event_item add foreign key(category_code) references mst_category(category_code);
alter table event_item add foreign key(supp_code) references mst_supplier(supp_code);

alter table event_location add foreign key(event_id) references event(id);
alter table event_location add foreign key(tillcode) references mst_tillcode(tillcode);
alter table event_location add foreign key(store_code) references mst_store(store_code);
alter table event_location add foreign key(location_code) references mst_location(loc_code);

alter table event_date add foreign key(event_id) references event(id);
alter table event_date add foreign key(tillcode) references mst_tillcode(tillcode);

alter table event_same_location add foreign key(event_id) references event(id);
alter table event_same_location add foreign key(store_code) references mst_store(store_code);
alter table event_same_location add foreign key(location_code) references mst_location(loc_code);




