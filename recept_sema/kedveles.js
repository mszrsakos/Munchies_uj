document.addEventListener("DOMContentLoaded", function () {

    const like = document.getElementById("like");
  
    like.addEventListener("click", function () {
  
        fetch("kedveles.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                recipe_id: window.RECIPE_ID
            })
        })
        .then(res => res.json())
        .then(data => {
  
            if (data.status === "liked") {
                like.src = "../imgs/red_heart.png";
            }
  
            if (data.status === "unliked") {
                like.src = "../imgs/clear_heart.png";
            }
  
        });
  
    });
  
  });