# Projet Symfony

## Thème choisi

Les données porteront sur le thème de la musique, en suivant les associations suivantes :

### ALBUM
  
Entity ALBUM (  
    status : enum["En ligne", "A venir"]  
    Musics : MUSIC[],  
    Artist : ARTIST,  
    Style : STYLE,  
    Fans : FAN[]  
 )  
ALBUM -- OneToMany --> MUSIC  
ALBUM -- ManyToOne --> ARTIST  
ALBUM -- ManyToOne --> STYLE  
ALBUM -- ManyToMany --> FAN  
  
### MUSIC
  
Entity MUSIC (   
    id : number,  
    titre : string,   
    artist_id : number  
 )  
MUSIC -- ManyToOne --> ARTIST  
  
### FAN
  
Entity FAN (  
    id : number,  
    username : string
)  
  
### ARTIST
  
Entity ARTIST (  
    id : number,  
    nom : string,  
)  

### STYLE
  
Entity STYLE (  
    id : number,  
    nom : string  
)  



