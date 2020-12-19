use sql7381971;

/* Creazione tabelle*/
CREATE TABLE Biblioteca(
	Email varchar(255) PRIMARY KEY,
    Indirizzo varchar(255),
    Nome varchar(255),
    URLSito varchar(255),
    Latitudine int(3),
    Longitudine int(3),
    Recapito varchar(255),
    Note varchar(255)
);

/* Manca il file non so come caricarlo*/
CREATE TABLE Foto(
	NomeFoto varchar(255),
    EmailBiblioteca varchar(255),
    FileFoto blob,
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    PRIMARY KEY (NomeFoto, EmailBiblioteca)
);

CREATE TABLE Utente(
    Email varchar(255) PRIMARY KEY,
    Nome varchar(255),
    Cognome varchar(255),
    PasswordUtente varchar(255),
    DataNascita date,
    LuogoNascita varchar(255),
    RecapitoTelefonico varchar(255),
    TipoUtente varchar(255),
    StatoUtente varchar(255)
);

CREATE TABLE UtentiIscritti(
	EmailBiblioteca varchar(255),
    EmailUtente varchar(255),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email),
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    PRIMARY KEY(EmailBiblioteca, EmailUtente)
);

CREATE TABLE Amministratore(
    EmailUtente varchar(255) PRIMARY KEY,
    Qualifica varchar(255),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE Volontario(
    EmailUtente varchar(255) PRIMARY KEY,
    MezzoDiTrasporto varchar(255),
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE Utilizzatore(
    EmailUtente varchar(255) PRIMARY KEY,
    Professione varchar(255),
    StatoProfilo varchar(255),
    DataDiRegistrazione date,
    FOREIGN KEY(EmailUtente) REFERENCES Utente(Email)
);

CREATE TABLE PostoLettura(
	Id int(10) AUTO_INCREMENT,
    EmailBiblioteca varchar(255),
    Ethernet boolean,
    Corrente boolean,
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    PRIMARY KEY(Id, EmailBiblioteca)
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

CREATE TABLE Libro(
	Codice int(10) PRIMARY KEY,
    Titolo varchar(255),
    Anno year,
    Genere varchar(255),
    NomeEdizione varchar(255)
);

CREATE TABLE Autore(
	CodiceLibro int(10),
    NomeAutore varchar(255),
    FOREIGN KEY(CodiceLibro) REFERENCES Libro(Codice),
    PRIMARY KEY(CodiceLibro, NomeAutore)
);

CREATE TABLE Cartaceo(
	CodiceLibro int(10) PRIMARY KEY,
    StatoDiConservazione varchar(255),
	StatoPrestito varchar(255),
	NumeroPagine int(10),
    NumeroScaffale int(10),
    FOREIGN KEY(CodiceLibro) REFERENCES Libro(Codice)
);

CREATE TABLE Ebook(
	CodiceLibro int(10) PRIMARY KEY,
    PDF blob,
    Dimensione double,
    NumeroAccessi int(10),
    FOREIGN KEY(CodiceLibro) REFERENCES Libro(Codice)
);

CREATE TABLE AccessoEbook(
	CodiceEbook int(10),
    EmailUtilizzatore varchar(255),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente),
    FOREIGN KEY(CodiceEbook) REFERENCES Ebook(CodiceLibro),
    PRIMARY KEY(CodiceEbook, EmailUtilizzatore)
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

CREATE TABLE LibriDisponibili(
    EmailBiblioteca varchar(255),
    CodiceLibro int(10),
    FOREIGN KEY(EmailBiblioteca) REFERENCES Biblioteca(Email),
    FOREIGN KEY(CodiceLibro) REFERENCES Libro(Codice),
    PRIMARY KEY(EmailBiblioteca, CodiceLibro)
);

CREATE TABLE PrenotazioneCartaceo(
    IdPrenotazioneCartaceo int(10) AUTO_INCREMENT PRIMARY KEY,
    IdCartaceo int(10),
    AvvioPrenotazione date,
    FinePrenotazione date,
    FOREIGN KEY(IdCartaceo) REFERENCES Cartaceo(CodiceLibro)
);

CREATE TABLE Consegna(
	IdConsegna int(10) AUTO_INCREMENT PRIMARY KEY,
    IdPrenotazioneCartaceo int(10),
    EmailVolontario varchar(255),
    EmailUtilizzatore varchar(255),
    Nome varchar(255),
    Tipo varchar(255),
    DataConsegna date,
    FOREIGN KEY(EmailVolontario) REFERENCES Volontario(EmailUtente),
    FOREIGN KEY(EmailUtilizzatore) REFERENCES Utilizzatore(EmailUtente),
    FOREIGN KEY(IdPrenotazioneCartaceo) REFERENCES PrenotazioneCartaceo(IdPrenotazioneCartaceo)
);