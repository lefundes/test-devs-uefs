-- Create sequences for auto-increment primary keys
CREATE SEQUENCE IF NOT EXISTS users_id_seq;
CREATE SEQUENCE IF NOT EXISTS posts_id_seq;
CREATE SEQUENCE IF NOT EXISTS tags_id_seq;

-- Set ownership of sequences
ALTER SEQUENCE users_id_seq OWNER TO uefs_user;
ALTER SEQUENCE posts_id_seq OWNER TO uefs_user;
ALTER SEQUENCE tags_id_seq OWNER TO uefs_user;