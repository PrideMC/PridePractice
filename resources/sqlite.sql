--#!sqlite
-- #{ init
CREATE TABLE IF NOT EXISTS practice_data (
    uuid TEXT,
	coins INTEGER DEFAULT 0,
    kills INTEGER DEFAULT 0,
    deaths INTEGER DEFAULT 0,
    wins INTEGER DEFAULT 0,
    loses INTEGER DEFAULT 0,
    elo INTEGER DEFAULT 0
);
-- #&
CREATE INDEX IF NOT EXISTS practice_data_kills ON practice_data (kills);
-- #&
CREATE INDEX IF NOT EXISTS practice_data_deaths ON practice_data (deaths);
-- #&
CREATE INDEX IF NOT EXISTS practice_data_wins ON practice_data (wins);
-- #&
CREATE INDEX IF NOT EXISTS practice_data_loses ON practice_data (loses);
-- #&
CREATE INDEX IF NOT EXISTS practice_data_elo ON practice_data (elo);
-- #}
-- #{ setKills
-- #	:uuid string
-- #    :kills int
INSERT OR IGNORE INTO practice_data (uuid, kills) VALUES (:uuid, 0);
-- #&
UPDATE practice_data SET kills = :kills WHERE uuid = :uuid;
-- #}
-- #{ getKills
-- #	:uuid string
SELECT kills FROM practice_data WHERE uuid = :uuid;
-- #}

-- #{ setDeaths
-- #	:uuid string
-- #    :deaths int
INSERT OR IGNORE INTO practice_data (uuid, deaths) VALUES (:uuid, 0);
-- #&
UPDATE practice_data SET deaths = :deaths WHERE uuid = :uuid;
-- #}
-- #{ getDeaths
-- #	:uuid string
SELECT deaths FROM practice_data WHERE uuid = :uuid;
-- #}

-- #{ setWins
-- #	:uuid string
-- #    :wins int
INSERT OR IGNORE INTO practice_data (uuid, wins) VALUES (:uuid, 0);
-- #&
UPDATE practice_data SET wins = :wins WHERE uuid = :uuid;
-- #}
-- #{ getWins
-- #	:uuid string
SELECT wins FROM practice_data WHERE uuid = :uuid;
-- #}

-- #{ setLoses
-- #	:uuid string
-- #    :loses int
INSERT OR IGNORE INTO practice_data (uuid, loses) VALUES (:uuid, 0);
-- #&
UPDATE practice_data SET loses = :loses WHERE uuid = :uuid;
-- #}
-- #{ getLoses
-- #	:uuid string
SELECT loses FROM practice_data WHERE uuid = :uuid;
-- #}

-- #{ setElo
-- #	:uuid string
-- #    :elo int
INSERT OR IGNORE INTO practice_data (uuid, elo) VALUES (:uuid, 0);
-- #&
UPDATE practice_data SET elo = :elo WHERE uuid = :uuid;
-- #}
-- #{ getElo
-- #	:uuid string
SELECT elo FROM practice_data WHERE uuid = :uuid;
-- #}

-- #{ setCoins
-- #	:uuid string
-- #    :coins int
INSERT OR IGNORE INTO practice_data (uuid, coins) VALUES (:uuid, 0);
-- #&
UPDATE player_data SET coins = :coins WHERE uuid = :uuid;
-- #}
-- #{ getCoins
-- #	:uuid string
SELECT coins FROM player_data WHERE uuid = :uuid;
-- #}