# Projet Symfony

## Thème choisi

Les données porteront sur le thème de la musique, en suivant les associations suivantes :

### ALBUM
  
Entity ALBUM (  
    status : enum["En ligne", "A venir"]  
    Musics : MUSIC[],  
    Artist : ARTIST,  
    Style : STYLE,  
    Commentaries : COMMENTARY[]  
 )  
ALBUM -- OneToMany --> MUSIC  
ALBUM -- ManyToOne --> ARTIST  
ALBUM -- OneToOne --> STYLE  
ALBUM -- ManyToMany --> COMMENTARY  
  
### MUSIC
  
Entity MUSIC (   
    id : number,  
    titre : string  
 )  
MUSIC -- OneToMany --> ARTIST  
  
### COMMENTARY
  
Entity COMMENTARY (  
    id : number,  
    message : string,  
    rating : number  
)  
  
### ARTIST
  
Entity ARTIST (  
    id : number,  
    nom : string  
)  
  
### STYLE
  
Entity STYLE (  
    id : number,  
    nom : string  
)  



