const mongoose = require('mongoose');

const postSchema = mongoose.Schema({
    titolo: {
        type: String, 
        required: true
    },
    tipoUtente: {
        type: String, 
        required: true
    },
    nomeUtente: {
        type: String, 
        required: true
    },
    timeStamp: {
        type : Date,
        default: Date.now()
       }
});

module.exports = mongoose.model('Posts', postSchema);