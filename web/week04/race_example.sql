CREATE TABLE event (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    location VARCHAR(100) NOT NULL,
    "date" date
);

INSERT INTO event (name, location, "date") 
VALUES
    ('Color Run', 'Awesome Events Center', '2018-07-20');

INSERT INTO event (name, location) 
VALUES
    ('Turkey Trot', 'Porter Park');

SELECT * FROM event;

CREATE TABLE participant (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age SMALLINT,
    gender VARCHAR(6),
    phone VARCHAR (15),
    email VARCHAR (100)
);

INSERT INTO participant (name, age, gender, phone, email)
VALUES
    ('Master Yoda', 362, 'Male', '555-555-5555', 'yoda.i.am@lightside.net');

INSERT INTO participant (name, age, gender, phone, email)
VALUES
    ('Han Solo', 68, 'Male', '333-333-3333', 'i.shot.first@mercenaries.net');

CREATE TABLE event_participant (
    event_id INT REFERENCES event(id) NOT NULL,
    participant_id INT REFERENCES participant(id) NOT NULL
);

INSERT INTO event_participant (event_id, participant_id)
VALUES
    (1, 1);

INSERT INTO event_participant (event_id, participant_id)
VALUES
    (1, 2);

INSERT INTO event_participant (event_id, participant_id)
VALUES
    (2, 2);

SELECT * FROM event_participant;