const express = require('express');
const router = express.Router();
const modelloPost = require('../modello/modello.js');

router.get('/', (req, res) =>{
    res.send('Post!')
});

router.post('/', (req, res) => {
    const postReq = new modelloPost({
        titolo: req.body.titolo,
        tipoUtente: req.body.tipoUtente,
        nomeUtente: req.body.nomeUtente
    });
    
    res.json(postReq);
    
    postReq.save()
           .then(data => {
                res.json(data);
            })
            .catch(err => {
                res.json({message:err});
            });
});

module.exports = router;