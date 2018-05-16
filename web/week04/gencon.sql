CREATE TABLE users (
    id SERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    passwrd VARCHAR(100) NOT NULL,
    display_name VARCHAR(100) NOT NULL
);

CREATE TABLE conferences (
    id SERIAL NOT NULL PRIMARY KEY,
    year SMALLINT NOT NULL,
    is_spring BOOLEAN NOT NULL
);

CREATE TABLE speakers (
    id SERIAL NOT NULL PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL
);

CREATE TABLE sessions (
    id SERIAL NOT NULL PRIMARY KEY,
    session_name VARCHAR(40) NOT NULL
);

CREATE TABLE talks (
    id SERIAL NOT NULL PRIMARY KEY,
    talk_title VARCHAR(150) NOT NULL,
    conference_id INT NOT NULL REFERENCES conferences(id),
    session_id INT NOT NULL REFERENCES sessions(id),
    speaker_id INT NOT NULL REFERENCES speakers(id)
);

CREATE TABLE notes (
    id SERIAL NOT NULL PRIMARY KEY,
    talk_id INT NOT NULL REFERENCES talks(id),
    user_id INT NOT NULL REFERENCES users(id),
    note_text TEXT NOT NULL
);

INSERT INTO users (username, passwrd, display_name)
VALUES
    ('jcanto', 'cs313', 'Joe');

INSERT INTO conferences (year, is_spring)
VALUES
    ('2018', true);

INSERT INTO sessions (session_name)
VALUES
    ('Saturday Morning Session');
    
INSERT INTO sessions (session_name)
VALUES
    ('Saturday Afternoon Session');
    
INSERT INTO sessions (session_name)
VALUES
    ('General Priesthood Session');

INSERT INTO sessions (session_name)
VALUES
    ('General Women''s Session');
    
INSERT INTO sessions (session_name)
VALUES
    ('Sunday Morning Session');
    
INSERT INTO sessions (session_name)
VALUES
    ('Sunday Afternoon Session');

INSERT INTO speakers (fullname) 
VALUES
    ('David A. Bednar');

INSERT INTO speakers (fullname) 
VALUES 
    ('Ronald A. Rasband');

INSERT INTO speakers (fullname) 
VALUES 
    ('Henry B. Eyring');

INSERT INTO speakers (fullname) 
VALUES 
    ('Russell M. Nelson');

INSERT INTO talks (talk_title, conference_id, session_id, speaker_id)
VALUES
    ('Meek and Lowly of Heart', 1, 2, 1);

INSERT INTO talks (talk_title, conference_id, session_id, speaker_id)
VALUES
    ('Behold! A Royal Army', 1, 3, 2);

INSERT INTO talks (talk_title, conference_id, session_id, speaker_id)
VALUES
    ('His Spirit to Be with You', 1, 5, 3);

INSERT INTO talks (talk_title, conference_id, session_id, speaker_id)
VALUES
    ('Revelation for the Church, Revelation for Our Lives', 1, 5, 4);

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (1, 1, 'What does it mean to be meek and lowly of heart?');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (2, 1, 'Stronger Elders Quorums will be able to do great things together.');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (3, 1, 'As we always remember Jesus Christ, we will have His Spirit to be with us.');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (4, 1, 'Knowing how to receive personal revelation from Heavenly Father will greatly bless you in your life, and will greatly bless the lives of those in your sphere of responsibilities.');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (1, 1, 'How can meekness be a strength?');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (2, 1, 'Our experiences combined will make us stronger and more capable as Elders Quorums.');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (3, 1, 'Having the Spirit with us at all times will help us stay on the straight and narrow path that leads to eternal life.');

INSERT INTO notes (talk_id, user_id, note_text)
VALUES
    (4, 1, 'Ponder, pray, then listen.');

-- SELECT * FROM users;
-- SELECT * FROM conferences;
-- SELECT * FROM sessions;
-- SELECT * FROM talks;
-- SELECT * FROM speakers;
-- SELECT * FROM notes;
-- SELECT * FROM notes WHERE talk_id=2;

-- DELETE FROM talks WHERE id=4;
-- DROP TABLE <table name>;

-- \dt
-- \d
-- \dt <table name>
-- \d <table name>