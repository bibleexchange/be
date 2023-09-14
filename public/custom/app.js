// Get the audio element
var music_player = document.getElementById('bkmrk-music-player');

if(music_player === null){
throw "Music Player does not exists ...";
}else{
var files = []
// Current index of the files array
var i = 0;

const playlist = document.getElementById('bkmrk-music-playlist');
const playlistTitle = document.getElementById('bkmrk-music-playlist-title');

let list = playlist.querySelectorAll("li");

Array.from(list).map((element, index) => {
element.addEventListener('click', function(){
setListItem(index);
playFile(index)
});
files.push({url: element.dataset.url, title: element.innerHTML})
});


function playFile(index){
music_player.src = files[index].url
playlistTitle.innerHTML = '"' + files[index].title + '"'
music_player.play()

}

// function for moving to next audio file
function next() {

// Check for last audio file in the playlist
if (i === files.length - 1) {
i = 0;
} else {
i++;
}

// Change the audio element source
playFile(i)
}

function setListItem(index) {
// Check for last audio file in the playlist
if (index > files.length - 1) {
index = 0;
}

// Change the audio element source
music_player.src = files[index].url;
}

//Setup Events
music_player.addEventListener('playing', function(e){
console.log('Audio playback has started ...');
console.log('Playback started at : '+ e.target.currentTime +" seconds");
}, false);
music_player.addEventListener('pause', function(e){
console.log('Audio playback has been paused ...');
console.log('Playback paused at : '+ e.target.currentTime +" seconds");
}, false);

music_player.addEventListener('ended', function(e){
console.log('Playback has ended');
}, false);
music_player.addEventListener('volumechange', function(e){
console.log("Volume has changed ...");
console.log("Volume is now "+ e.target.volume);
}, false);

//Setup Controls
var play = document.querySelector('bkmrk-music-playlist');

document.getElementById('bkmrk-music-playlist-next').addEventListener('click', function(){
next();
}, false);

//
document.getElementById('bkmrk-music-playlist-stop').addEventListener('click', function(){
if(music_player.src === undefined) {
playFile(i)
}else{
music_player.paused? music_player.play():music_player.pause();
}

}, false);

// Start the player
playFile(i)

// Listen for the music ended event, to play the next audio file
music_player.addEventListener('ended', next, false)}