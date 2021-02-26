DROP DATABASE IF EXISTS ebiblio;
CREATE SCHEMA ebiblio;
USE ebiblio;

/* Creazione tabelle*/
CREATE TABLE Biblioteca(
	Nome varchar(255) PRIMARY KEY,
    Indirizzo varchar(255),
    Email varchar(255),
    URLSito varchar(255),
    Latitudine double(20,5),
    Longitudine double(20,5),
    Recapito int(15),
    Note varchar(255)
);

CREATE TABLE Foto(
	NomeFoto varchar(255),
    NomeBiblioteca varchar(255),
    FileFoto blob,
    FOREIGN KEY(NomeBiblioteca) REFERENCES Biblioteca(Nome) ON DELETE CASCADE,
    PRIMARY KEY (NomeFoto, NomeBiblioteca)
);

CREATE TABLE PostoLettura(
	Id int(10) AUTO_INCREMENT,
    NomeBiblioteca varchar(255),
    Ethernet boolean,
    Corrente boolean,
    FOREIGN KEY(NomeBiblioteca) REFERENCES Biblioteca(Nome) ON DELETE CASCADE,
    PRIMARY KEY(Id, NomeBiblioteca)
);

CREATE TABLE Libro(
	CodiceISBN int(10) PRIMARY KEY,
    Titolo varchar(255),
    Anno int(4),
    Genere varchar(255),
    NomeEdizione varchar(255),
    TipoLibro enum("Cartaceo","Ebook", "Entrambi")
);

CREATE TABLE LibriDisponibili(
    NomeBiblioteca varchar(255),
    CodiceISBN int(10),
    NumeroCopie int(10),
    FOREIGN KEY(NomeBiblioteca) REFERENCES Biblioteca(Nome) ON DELETE CASCADE,
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN) ON DELETE CASCADE,
    PRIMARY KEY(NomeBiblioteca, CodiceISBN)
);

CREATE TABLE Autore(
	Id integer(10) AUTO_INCREMENT PRIMARY KEY,
    NomeAutore varchar(255)
);

CREATE TABLE Scrittori(
	IdAutore int(10),
    CodiceISBN int(10),
    FOREIGN KEY(IdAutore) REFERENCES Autore(Id) ON DELETE CASCADE,
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN) ON DELETE CASCADE
);


CREATE TABLE Cartaceo(
	CodiceISBN int(10) PRIMARY KEY,
    StatoDiConservazione enum("Ottimo","Buono","Non Buono", "Scadente"),
	StatoPrestito enum("Disponibile","Prenotato","Consegnato"),
	NumeroPagine int(10),
    NumeroScaffale int(10),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN) ON DELETE CASCADE
);

CREATE TABLE Ebook(
	CodiceISBN int(10) PRIMARY KEY,
    PDF blob,
    Dimensione double,
    NumeroAccessi int(10),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN)  ON DELETE CASCADE
);


CREATE TABLE Utente(
    Email varchar(255) PRIMARY KEY,
    Nome varchar(255),
    Cognome varchar(255),
    PasswordUtente varchar(255),
    DataNascita date,
    LuogoNascita varchar(255),
    RecapitoTelefonico varchar(255),
    TipoUtente enum('Utilizzatore','Volontario','Amministratore','SuperUser') NOT NULL
);

CREATE TABLE Amministratore(
    EmailUtente varchar(255) PRIMARY KEY,
    NomeBibliotecaAmministrata varchar(255),
    Qualifica varchar(255),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email) ON DELETE CASCADE,
    FOREIGN KEY(NomeBibliotecaAmministrata) REFERENCES Biblioteca(Nome) 
);

CREATE TABLE Volontario(
    EmailUtente varchar(255) PRIMARY KEY,
    MezzoDiTrasporto enum("Piedi","Bici","Auto"),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email) ON DELETE CASCADE
);

CREATE TABLE Utilizzatore(
    EmailUtente varchar(255) PRIMARY KEY,
    Professione varchar(255),
    StatoAccount enum("Attivo","Sospeso"),
    DataDiRegistrazione date,
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email) ON DELETE CASCADE
);

CREATE TABLE PrenotazioneCartaceo(
    IdPrenotazioneCartaceo int(10) auto_increment,
    CodiceISBNCartaceo int(10),
    AvvioPrenotazione date,
    FinePrenotazione date,
    EmailUtilizzatore varchar(255),
    NomeBiblioteca varchar(255),
    FOREIGN KEY(CodiceISBNCartaceo) REFERENCES Cartaceo(CodiceISBN) ON DELETE CASCADE,
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente) ON DELETE CASCADE,
    FOREIGN KEY(NomeBiblioteca) REFERENCES Biblioteca(Nome) ON DELETE CASCADE,
    PRIMARY KEY(IdPrenotazioneCartaceo, CodiceISBNCartaceo)
);

CREATE TABLE Consegna(
	IdConsegna int(10),
    IdPrenotazioneCartaceo int(10),
    EmailVolontario varchar(255),
    EmailUtilizzatore varchar(255),
    Note varchar(200),
    Tipo enum("Restituzione","Affidamento"),
    DataConsegna date,
    FOREIGN KEY(EmailVolontario) REFERENCES Volontario(EmailUtente) ON DELETE CASCADE,
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente) ON DELETE CASCADE,
    FOREIGN KEY(IdPrenotazioneCartaceo) REFERENCES PrenotazioneCartaceo(IdPrenotazioneCartaceo),
    PRIMARY KEY(IdConsegna, IdPrenotazioneCartaceo)
);

CREATE TABLE AccessoEbook(
	CodiceISBN int(10),
    EmailUtilizzatore varchar(255),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente) ON DELETE CASCADE,
    FOREIGN KEY(CodiceISBN) REFERENCES Ebook(CodiceISBN) ON DELETE CASCADE,
    PRIMARY KEY(CodiceISBN, EmailUtilizzatore)
);


CREATE TABLE Messaggio(
    Id int(10) AUTO_INCREMENT PRIMARY KEY,
    EmailAmministratore varchar(255),
    EmailUtilizzatore varchar(255),
    DataMessaggio date,
    Titolo varchar(255),
    Testo varchar(255),
    FOREIGN KEY(EmailAmministratore) REFERENCES Amministratore(EmailUtente) ON DELETE CASCADE,
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente) ON DELETE CASCADE
);

CREATE TABLE Segnalazione(
    Id int(10) AUTO_INCREMENT PRIMARY KEY,
    EmailAmministratore varchar(255),
    EmailUtilizzatore varchar(255),
    DataSegnalazione date,
    Nota varchar(255),
    FOREIGN KEY(EmailAmministratore) REFERENCES Amministratore(EmailUtente),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente) ON DELETE CASCADE
);

CREATE TABLE PrenotazionePostoLettura(
	IdPostoLettura int(10),
    EmailUtilizzatore varchar(255),
    OraInizio time,
    OraFine time,
    DataPrenotazione date,
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente),
    FOREIGN KEY(IdPostoLettura) REFERENCES PostoLettura(Id),
    PRIMARY KEY(IdPostoLettura, EmailUtilizzatore, OraInizio, OraFine, DataPrenotazione)
);


/* Creazione Trigger */
                    
DELIMITER |
CREATE TRIGGER AccountSospeso
AFTER INSERT ON SEGNALAZIONE
FOR EACH ROW
BEGIN
	UPDATE Utilizzatore 
    SET StatoAccount = "Sospeso"
	WHERE EmailUtente = NEW.EmailUtilizzatore
    AND StatoAccount <> "Sospeso"
    AND EmailUtente IN (SELECT EmailUtilizzatore 
						FROM SEGNALAZIONE
						GROUP BY EmailUtilizzatore
						HAVING Count(*)>3);
END |   

DELIMITER |
CREATE TRIGGER LibroPrenotato
AFTER INSERT ON PrenotazioneCartaceo
FOR EACH ROW
BEGIN
	UPDATE Cartaceo 
    SET StatoPrestito = "Prenotato"
    WHERE CodiceISBN = NEW.CodiceISBNCartaceo
    AND StatoPrestito = "Disponibile";
END |;
	

DELIMITER |
CREATE TRIGGER LibroConsegnato
AFTER INSERT ON Consegna
FOR EACH ROW
BEGIN
	UPDATE Cartaceo 
    SET StatoPrestito = "Consegnato" 
    WHERE StatoPrestito = "Prenotato"
    AND CodiceISBN IN ( SELECT CodiceISBNCartaceo
						FROM PrenotazioneCartaceo
						WHERE IdPrenotazioneCartaceo IN (SELECT IdPrenotazioneCartaceo
														 FROM Consegna
														 WHERE IdConsegna = NEW.IdConsegna
														 AND NEW.Tipo = "Affidamento"));
END |


DELIMITER |
CREATE TRIGGER LibroRestituito
AFTER INSERT ON Consegna
FOR EACH ROW
BEGIN                                        
	UPDATE Cartaceo 
    SET StatoPrestito = "Disponibile" 
    WHERE StatoPrestito = "Consegnato"
    AND CodiceISBN IN ( SELECT CodiceISBNCartaceo
						FROM PrenotazioneCartaceo
						WHERE IdPrenotazioneCartaceo IN (SELECT IdPrenotazioneCartaceo
														 FROM Consegna
														 WHERE IdConsegna = NEW.IdConsegna
														 AND NEW.Tipo = "Restituzione"));
END |
