function updatePoints(x) {
  let xhr = new XMLHttpRequest();

  xhr.open('POST', './../pages/points.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              console.log('Points mis à jour avec succès !');
          } else {
              console.error('Erreur lors de la mise à jour des points');
          }
      }
  };

  let points = x;
  let data = 'points=' + encodeURIComponent(points);
  xhr.send(data);
}

function absent(x, y, z) {
    let xhr = new XMLHttpRequest();
  
    xhr.open('POST', './../pages/absent.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('L\'absence a été enregistrée avec succès !');
            } else {
                console.error('Erreur lors de la mise à jour de l\'abscence');
            }
        }
    };
  
    let points = x;
    let date = y;
    let 
    let data = 'points=' + encodeURIComponent(points);
    xhr.send(data);
  }
  
