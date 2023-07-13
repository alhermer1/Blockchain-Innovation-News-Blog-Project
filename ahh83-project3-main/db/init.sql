
CREATE TABLE users (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  users (id, name, username, password)
VALUES
  (
    1,
    'Kyle Harms',
    'kyle',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );

INSERT INTO
  users (id, name, username, password)
VALUES
  (
    2,
    'Bill Weld',
    'bill',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );

INSERT INTO
  users (id, name, username, password)
VALUES
  (
    3,
    'Gary Johnson',
    'gary',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );


CREATE TABLE sessions (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE groups (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL UNIQUE,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  groups (id, name)
VALUES
  (1, 'admin');

CREATE TABLE user_groups (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  group_id INTEGER NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO
  user_groups (user_id, group_id)
VALUES
  (1, 1);



CREATE TABLE articles (
	id	INTEGER NOT NULL UNIQUE,
	company_name	TEXT NOT NULL,
    author  TEXT NOT NULL,
    date_a  TEXT NOT NULL,
    summary  TEXT NOT NULL,
    full_text  TEXT NOT NULL,
    temp_file_path TEXT,
    citation TEXT,
    PRIMARY KEY (id AUTOINCREMENT)
);



INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (1,'CoinBase','Brian Armstrong','04/11/2023','Coinbase is a cryptocurrency app that allows users, including merchants, consumers, and traders, to buy and sell crypto currencies while building a digital portfolio of their investments. ','Coinbase is a cryptocurrency app that allows users, including merchants, consumers, and traders, to buy and sell crypto currencies while building a digital portfolio of their investments. The app also provides several merchant processing systems and tools that are compatible with some of the largest websites on the internet.', 'https://logosarchive.com/logo/coinbase/');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (2,'Paxful','Artur Schaback','04/11/2023','Unlike its competitors, Paxful is a peer-to-peer cryptocurrency marketplace that also serves as a universal money translator.','Unlike its competitors, Paxful is a peer-to-peer cryptocurrency marketplace that also serves as a universal money translator. With a platform that includes over 300 financial networks, Paxful offers opportunities to both buyers and sellers alike that may not have access to banking services.
', 'https://commons.wikimedia.org/wiki/File:Paxful_Logo_Black.png');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (3,'Coinme','Michael Smyers','04/11/2023','Coinme is a cryptocurrency startup that aims to make investing in crypto accessible to a wider population by partnering with Coinstar to create Bitcoin kiosks across the US.','Coinme is a cryptocurrency startup that aims to make investing in crypto accessible to a wider population by partnering with Coinstar to create Bitcoin kiosks across the US. Users can make cash investments in crypto using the kiosks and keep track of their financial transactions through the Coinme app.', 'https://coinme.com');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (4,'Mythical Games','John Linden','04/11/2023','Mythical Games is a studio creating video games and online experiences. Most notably, their blockchain-based game Blankos was released in 2019.','Mythical Games is a studio creating video games and online experiences. Most notably, their blockchain-based game Blankos was released in 2019. The ethos of this startup is to provide financial agency through digital assets, secondary markets, and verifiable scarcity.','https://seeklogo.com/vector-logo/442165/mythical-games');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (5,'Republic','Kendrick Nguyen','04/11/2023','Republic is an investment platform that leverages the power of blockchain technology to help users invest in cryptocurrencies, real estate, and more.','Republic is an investment platform that leverages the power of blockchain technology to help users invest in cryptocurrencies, real estate, and more. The goal of this startup is to make building an angel investment portfolio accessible to more people interested in this type of investing.', 'https://branditechture.agency/brand-logos/downloading/?pack=be4b102d12d8b7041d5db84bb0aa7abb');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (6,'Spring Labs','Adam Jiwan','04/11/2023','With Spring Labs’s platform, users can expect faster and more secure information exchange due to the startup’s leveraging of blockchain transparency and data collection capabilities.','With Spring Labs’s platform, users can expect faster and more secure information exchange due to the startup’s leveraging of blockchain transparency and data collection capabilities. With Spring Labs, fraud is reduced through an increase in verified identities, and the protection of consumer data is prioritized.', 'https://springlabs.com');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (7,'SALT','Benjamin Yablon','04/11/2023','Using the SALT platform, users can leverage their cryptocurrency for real cash loans starting at $5,000 from 1-36 months.','Using the SALT platform, users can leverage their cryptocurrency for real cash loans starting at $5,000 from 1-36 months. Cryptocurrencies that are compatible with the platform include Bitcoin, Ether, and Dogecoin, and the platform is available in a majority of the US states as well as countries across the globe.', 'https://branditechture.agency/brand-logos/download/salt-salt-2/#google_vignette');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (8,'Gemini','Cameron Winklevoss','04/11/2023','Gemini is a cryptocurrency exchange that utilizes blockchain technology for cryptocurrency and trading capabilities.','Gemini is a cryptocurrency exchange that utilizes blockchain technology for cryptocurrency and trading capabilities. Users can buy, sell, or exchange a variety of crypto assets including Bitcoin, Ether, and Litecoin.', 'https://www.vectorlogo.zone/logos/gemini/index.html');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (9,'BlockFi','Flori Marquez','04/11/2023','BlockFi is a crypto investment and blockchain wealth management platform that enables its customers to invest in cryptocurrency, digital assets, consumer lending products, and other products related to the crypto-asset ecosystem.','BlockFi is a crypto investment and blockchain wealth management platform that enables its customers to invest in cryptocurrency, digital assets, consumer lending products, and other products related to the crypto-asset ecosystem. Their primary mission is to provide their customers with transparency, an efficient platform they can transact on, and liquidity.', 'https://getlogovector.com/blockfi-logo-vector-svg/#google_vignette');

INSERT INTO articles (id, company_name, author, date_a, summary, full_text, citation) VALUES (10,'MeetKai','Adam Joosten','04/11/2023','MeetKai is a startup developing a metaverse that’s rooted in reality in order to enrich its users’ lives.','MeetKai is a startup developing a metaverse that’s rooted in reality in order to enrich its users’ lives. Their global vision is to become a new frontier of reality that’s inclusive and open to all, weaving in the virtual world with reality in productive and exciting ways. Users can learn, shop, create, and explore an enhanced reality, own various assets and objects in the metaverse, and have the ability to access this world anywhere through just a web browser.', 'https://www.pngaaa.com/download/6620714');



CREATE TABLE tags (
  tag_id INTEGER NOT NULL UNIQUE,
  tag_name TEXT UNIQUE,
  PRIMARY KEY (tag_id AUTOINCREMENT)
);

INSERT INTO tags (tag_id, tag_name) VALUES (1, 'DAOs');

INSERT INTO tags (tag_id, tag_name) VALUES (2, 'DEFI');

INSERT INTO tags (tag_id, tag_name) VALUES (3, 'GOVERNANCE');

INSERT INTO tags (tag_id, tag_name) VALUES (4, 'Crypto');

INSERT INTO tags (tag_id, tag_name) VALUES (5, 'Arbitrage');

INSERT INTO tags (tag_id, tag_name) VALUES (6, 'Quant');



CREATE TABLE arttags (
  articles_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,
  FOREIGN KEY (articles_id) REFERENCES articles (id),
  FOREIGN KEY (tag_id) REFERENCES tags (tag_id)
);


INSERT INTO arttags (articles_id, tag_id) VALUES (1,3);
INSERT INTO arttags (articles_id, tag_id) VALUES (1,2);
INSERT INTO arttags (articles_id, tag_id) VALUES (2,3);
INSERT INTO arttags (articles_id, tag_id) VALUES (3,3);
INSERT INTO arttags (articles_id, tag_id) VALUES (3,5);
INSERT INTO arttags (articles_id, tag_id) VALUES (3,1);
INSERT INTO arttags (articles_id, tag_id) VALUES (4,6);
INSERT INTO arttags (articles_id, tag_id) VALUES (5,2);
INSERT INTO arttags (articles_id, tag_id) VALUES (6,1);
INSERT INTO arttags (articles_id, tag_id) VALUES (6,2);
INSERT INTO arttags (articles_id, tag_id) VALUES (6,3);
INSERT INTO arttags (articles_id, tag_id) VALUES (7,3);
INSERT INTO arttags (articles_id, tag_id) VALUES (8,2);
INSERT INTO arttags (articles_id, tag_id) VALUES (9,6);
INSERT INTO arttags (articles_id, tag_id) VALUES (10,5);
