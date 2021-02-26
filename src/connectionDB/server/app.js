const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const post = require('./routes/posts.js');


//middleware
app.use(bodyParser.json());
app.use('/post', post);

//connessione
mongoose.connect('mongodb+srv://superUser:superUser@cluster0.ewq8p.mongodb.net/ebiblio?retryWrites=true&w=majority',{userNewParser: true}, () => console.log('connesso!'));

//in ascolto
app.listen(3000);