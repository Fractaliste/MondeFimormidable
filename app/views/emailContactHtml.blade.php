<body style="background-color: #FFDB73; padding: 10px;">
    <section>
        <header>
            <img src="{{$message->embed('email/titre.png')}}" style="margin: 7px 0px 0px 7px"/>
            <img src="{{$message->embed('email/banniere.png')}}" 
                 style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;
                 max-height: 3em; width: 70%;"/>
        </header>
        <article style="margin-left: 10px;">
            <h2>Objet : Vous avez envoyé un message depuis http://monde-fimormidable.fr</h2>
            <p>Bonjour, et merci pour l'intérêt que vous portez à mon site !</p>
            <p>Je vous confirme que j'ai bien reçu votre message. Je vais essayer d'y répondre le plus vite possible.</p>
            <p>Pour rappel voici son contenu :</p>
            <div style="background-color: #FFCE40; padding: 10px;">
                <p><strong>Nom : </strong>{{{$nom}}}</p>
                <p><strong>Email : </strong>{{{$email}}}</p>
                <p><strong>Téléphone : </strong>{{{$telephone}}}</p>
                <p><strong>Motif de contact : </strong>{{{Config::get('enum.motif_contact.'.$motif)}}}</p>
                <p><strong>Message : </strong>{{{$texte}}}</p>
            </div>
        </article>
        <footer>
            <p>A très bientôt sur <a href="http://monde-fimormidable.fr">http://monde-fimormidable.fr</a> !</p>
            <p style="margin-left: 30px;">Amandine</p>
            <p style="font-size: 0.8em; font-style: italic;">PS : Ceci est un message automatique, merci de ne pas y répondre.</p>
        </footer>
    </section>
</body>
