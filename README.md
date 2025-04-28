# Reciπ

## Description
Reciπ is an educational platform that allows users to insert their own recipes
and view those inserted by others. Much like a recipe forum, it democratizes the search for recipes,
which are traditionally pubblished by websites in a curated or standardized content. However, unlike typical 
forums, the platform ensures that all recipes follow a standardized format, making it easy to filter 
them based on users' diets, dietary restrictions, and personal preferences.

## E/R Diagram
``` mermaid
flowchart LR

User <-- 1 --> Has1{Has} <-- N --> Recipe
User <-- N --> Bookmarks1{Bookmarks} <--N--> Recipe

Recipe <-- 1 --> Has4{Has} <-- N --> Container  
Container <-- 1 --> In1{In} <-- 1 -->  Step 
Recipe <-- 1 --> Has2{Has} <-- N --> RecipeIngredient
Step <-- 1 --> RelativeTo1{Relative To} <-- 1 --> RecipeIngredient

User <-- N --> Dislikes{Dislikes} <-- N --> Ingredient
User <-- N --> Likes{Likes} <-- N --> Ingredient
User <-- N --> Loves{Loves} <-- N --> Ingredient
RecipeIngredient <-- N --> Is1{Is} <-- 1 --> Ingredient
```

## Fonts Used
- https://fonts.google.com/specimen/Caveat+Brush
