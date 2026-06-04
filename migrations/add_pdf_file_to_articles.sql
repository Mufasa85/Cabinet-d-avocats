-- Migration: Ajouter le champ pdf_file à la table articles
-- Permet aux avocats d'uploader un PDF lié à leur article

USE cabinet_platform;

-- Ajouter la colonne pdf_file si elle n'existe pas
ALTER TABLE articles ADD COLUMN pdf_file VARCHAR(255);

-- Ajouter un index pour les recherches
ALTER TABLE articles ADD INDEX idx_pdf_file (pdf_file);