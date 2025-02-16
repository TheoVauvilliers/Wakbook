<?php

namespace App\Api\Import\Enum;

enum EndpointEnum: string
{
    case Actions = 'actions';
    case Blueprints = 'blueprints';
    case CollectibleResources = 'collectibleResources';
    case EquipmentItemTypes = 'equipmentItemTypes';
    case HarvestLoots = 'harvestLoots';
    case ItemTypes = 'itemTypes';
    case ItemProperties = 'itemProperties';
    case JobsItems = 'jobsItems';
    case RecipeCategories = 'recipeCategories';
    case RecipeIngredients = 'recipeIngredients';
    case RecipeResults = 'recipeResults';
    case Recipes = 'recipes';
    case ResourceTypes = 'resourceTypes';
    case Resources = 'resources';
    case States = 'states';
}
