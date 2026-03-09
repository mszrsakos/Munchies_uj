(function () {
    const baseServings = Number(window.RECIPE_BASE_SERVINGS || 1);
    const ingredients = Array.isArray(window.RECIPE_INGREDIENTS) ? window.RECIPE_INGREDIENTS : [];
  
    let servings = baseServings;
  
    function formatNumber(n) {
      // show integers cleanly, decimals if needed
      if (Number.isInteger(n)) return String(n);
      return String(Math.round(n * 100) / 100);
    }
  
    function updateIngredients() {
      const ul = document.querySelector(".hozzavalok ul");
      if (!ul) return;
  
      ul.innerHTML = "";
  
      const factor = servings / baseServings;
  
      ingredients.forEach((ing) => {
        const li = document.createElement("li");
  
        if (ing.amount !== null && ing.amount !== undefined && ing.amount !== "") {
          const newAmount = Number(ing.amount) * factor;
          const unit = ing.unit ? (ing.unit + " ") : "";
          li.textContent = `${formatNumber(newAmount)} ${unit}${ing.name}`;
        } else {
          li.textContent = ing.name; // “ízlés szerint” etc.
        }
  
        ul.appendChild(li);
      });
    }
  
    window.increase = function () {
      servings++;
      document.getElementById("count").textContent = servings;
      updateIngredients();
    };
  
    window.decrease = function () {
      if (servings > 1) {
        servings--;
        document.getElementById("count").textContent = servings;
        updateIngredients();
      }
    };
  
    document.addEventListener("DOMContentLoaded", updateIngredients);
  })();
  