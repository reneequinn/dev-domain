-- Create DB
create database if not exists codeclubdb;
use codeclubdb;

-- Create member table
drop table if exists members;
create table members (
  member_username varchar(15) not null,
  member_first_name varchar(20) not null,
  member_last_name varchar(30) not null,
  member_email varchar(40) not null,
  member_phone char(10) not null,
  member_password varchar(64) not null,
  primary key (member_username)
);

-- Create venue table
drop table if exists venues;
create table venues (
  venue_name varchar(100) not null,
  venue_lat varchar(30) not null,
  venue_lng varchar(30) not null,
  venue_address varchar(255) not null,
  primary key(venue_name)
);

-- Create events table
drop table if exists events;
create table events (
  event_id int auto_increment not null,
  event_name varchar(100) not null,
  event_datetime datetime not null,
  event_venue varchar(255),
  event_desc longtext not null,
  primary key(event_id),
  foreign key (event_venue) references venues(venue_name)
);

-- Add venues
insert into venues (venue_name, venue_lat, venue_lng, venue_address) values
('Dev Domain HQ', '-34.9243745', '138.595478', '120 Currie St, Adelaide'),
('Lot Fourteen', '-34.9201455', '138.6084275', 'Cnr North Terrace and Frome Road, Adelaide'),
('Adelaide Convention Centre', '-34.9203084', '138.5944767', 'North Terrace, Adelaide');

-- Add events
insert into events (event_name, event_datetime, event_venue, event_desc) values
('Monthly Meetup', '2020-07-03 18:30:00', 'Dev Domain HQ', 'Our monthly meetup held at our headquarters. Come along for drinks, nibbles and a chat with local developers.'),
('JAMstack Workshop', '2020-06-20 10:00:00', 'Lot Fourteen', 'All day workshop focused on getting up and running with the JAMstack. Learn how JavaScript, APIs and Markup can create fast and accessible web applications.'),
('Dev Domain Conference', '2020-07-18 09:00:00', 'Adelaide Convention Centre', 'Annual conference held at the Convention Centre. Workshops, seminars, activities and much more. Guest speakers to be announced soon.');