CREATE TABLE topics (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);

INSERT INTO topics (name)
VALUES
    ('Faith'), ('Sacrifice'), ('Charity');

CREATE TABLE scripture_topics (
    scripture_id INT NOT NULL UNIQUE REFERENCES scriptures(scripture_id),
    topic_id INT NOT NULL UNIQUE REFERENCES topics (id)
);