use sql7381971;

/* Creazione tabelle*/
CREATE TABLE Biblioteca(
	Nome varchar(255) PRIMARY KEY,
    Indirizzo varchar(255),
    Email varchar(255),
    URLSito varchar(255),
    Latitudine int(3),
    Longitudine int(3),
    Recapito varchar(255),
    Note varchar(255)
);

CREATE TABLE Foto(
	NomeFoto varchar(255),
    EmailBiblioteca varchar(255),
    FileFoto blob,
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    PRIMARY KEY (NomeFoto, EmailBiblioteca)
);

CREATE TABLE PostoLettura(
	Id int(10) AUTO_INCREMENT,
    EmailBiblioteca varchar(255),
    Ethernet boolean,
    Corrente boolean,
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    PRIMARY KEY(Id, EmailBiblioteca)
);

CREATE TABLE Libro(
	CodiceISBN int(10) PRIMARY KEY,
    Titolo varchar(255),
    Anno year,
    Genere varchar(255),
    NomeEdizione varchar(255)
);

CREATE TABLE LibriDisponibili(
    EmailBiblioteca varchar(255),
    CodiceISBN int(10),
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN),
    PRIMARY KEY(EmailBiblioteca, CodiceLibro)
);

CREATE TABLE Autore(
	Id integer(10) AUTO_INCREMENT PRIMARY KEY,
    NomeAutore varchar(255)
);

CREATE TABLE Scrittori(
	IdAutore integer(10),
    CodiceISBN int(10),
    FOREIGN KEY(IdAutore) REFERENCES Autore(Id),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN)
);

CREATE TABLE Cartaceo(
	CodiceISBN int(10) PRIMARY KEY,
    StatoDiConservazione enum("Ottimo","Buono","Non buono", "Scadente"),
	StatoPrestito enum("Disponibile","Prenotato","Consegnato"),
	NumeroPagine int(10),
    NumeroScaffale int(10),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN)
);

CREATE TABLE Ebook(
	CodiceISBN int(10) PRIMARY KEY,
    PDF blob,
    Dimensione double,
    NumeroAccessi int(10),
    FOREIGN KEY(CodiceISBN) REFERENCES Libro(CodiceISBN)
);

CREATE TABLE PrenotazioneCartaceo(
    IdPrenotazioneCartaceo int(10) AUTO_INCREMENT PRIMARY KEY,
    CodiceISBNCartaceo int(10),
    AvvioPrenotazione date,
    FinePrenotazione date,
    FOREIGN KEY(CodiceISBNCartaceo) REFERENCES Cartaceo(CodiceISBN)
);

CREATE TABLE Consegna(
    IdPrenotazioneCartaceo int(10) PRIMARY KEY,
    EmailVolontario varchar(255),
    EmailUtilizzatore varchar(255),
    Nome varchar(200),
    Tipo enum("Restituzione","Affidamento"),
    DataConsegna date,
    StatoConsegna varchar(255),
    FOREIGN KEY(EmailVolontario) REFERENCES Volontario(EmailUtente),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente),
    FOREIGN KEY(IdPrenotazioneCartaceo) REFERENCES PrenotazioneCartaceo(IdPrenotazioneCartaceo)
);

CREATE TABLE AccessoEbook(
	CodiceISBN int(10),
    EmailUtilizzatore varchar(255),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente),
    FOREIGN KEY(CodiceISBN) REFERENCES Ebook(CodiceISBN),
    PRIMARY KEY(CodiceISBN, EmailUtilizzatore)
);

CREATE TABLE Utente(
    Email varchar(255) PRIMARY KEY,
    Nome varchar(255),
    Cognome varchar(255),
    PasswordUtente varchar(255),
    DataNascita date,
    LuogoNascita varchar(255),
    RecapitoTelefonico varchar(255),
    TipoUtente varchar(255)
);

CREATE TABLE Amministratore(
    EmailUtente varchar(255) PRIMARY KEY,
    Qualifica varchar(255),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE Volontario(
    EmailUtente varchar(255) PRIMARY KEY,
    MezzoDiTrasporto enum("Piedi","Bici","Auto"),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE Utilizzatore(
    EmailUtente varchar(255) PRIMARY KEY,
    Professione varchar(255),
    StatoAccount enum("Attivo","Sospeso"),
    DataDiRegistrazione date,
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE Messaggio(
    Id int(10) AUTO_INCREMENT PRIMARY KEY,
    EmailAmministratore varchar(255),
    EmailUtilizzatore varchar(255),
    DataMessaggio date,
    Titolo varchar(255),
    Testo varchar(255),
    FOREIGN KEY(EmailAmministratore) REFERENCES Amministratore(EmailUtente),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente)
);

CREATE TABLE Segnalazione(
    Id int(10) AUTO_INCREMENT PRIMARY KEY,
    EmailAmministratore varchar(255),
    EmailUtilizzatore varchar(255),
    DataSegnalazione date,
    Nota varchar(255),
    FOREIGN KEY(EmailAmministratore) REFERENCES Amministratore(EmailUtente),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente)
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

/* Nel	caso	in	cui	un	utilizzatore	riceva cumulativamente più	di	tre	
segnalazioni (anche	 da	 amministratori	 di	 biblioteche	 diverse),	 lo stato	 dell’account viene	
settato	 a	 “Sospeso” */

CREATE TRIGGER AccountSospeso
AFTER INSERT ON SEGNALAZIONE
FOR EACH ROW
	UPDATE UTILIZZATORE
	SET StatoAccount = "Sospeso"
	WHERE StatoAccount <> "Sospeso"
	AND Email IN (SELECT EmailUtilizzatore 
					FROM SEGNALAZIONE
					GROUP BY EmailUtilizzatore
					HAVING Count(*)>3);


CREATE TRIGGER NewStatoPrenotato
AFTER INSERT ON PrenotazioneCartaceo
FOR EACH ROW
	UPDATE Cartaceo 
    SET StatoPrestito = "Prenotato"
    WHERE CodiceISBN=NEW.CodiceISBNCartaceo;
				
CREATE TRIGGER NewStatoConsegnato
AFTER INSERT ON Consegna
FOR EACH ROW
	UPDATE Cartaceo SET StatoPrestito = "Consegnato" 
	WHERE CodiceISBN=NEW.CodiceISBNCartaceo
    AND NEW.Tipo = "Affidamento";
    
CREATE TRIGGER NewStatoDisponibile
AFTER INSERT ON Consegna
FOR EACH ROW
	UPDATE Cartaceo SET StatoPrestito = "Disponibile" 
	WHERE CodiceISBN=NEW.CodiceISBNCartaceo
    AND NEW.Tipo = "Restituzione";
    

                
/* Creazione Utente */

CREATE USER utenteSospeso;
CREATE USER utenteUtilizzatore;
CREATE USER utenteAmministratore;
CREATE USER utenteVolontario;

/*
	L'utente sospeso non può fare niente - 
     "impedendo qualsiasi accesso alla piattaforma da	parte dell’utente sanzionato"
	
    L'utente amministratore può fare tutto
    
    L'utente volontario può avere accesso (insert + select + update + delete) evento di consegna
*/

GRANT SELECT ON	Consegna TO utenteVolontario;
GRANT INSERT ON	Consegna TO utenteVolontario;
GRANT DELETE ON	Consegna TO utenteVolontario;
GRANT UPDATE ON	Consegna TO utenteVolontario;


