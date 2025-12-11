-- Add client linkage for user accounts to restrict client visibility
ALTER TABLE users
    ADD COLUMN IF NOT EXISTS CLIENT_CODE VARCHAR(64) NULL AFTER CNATURE;

-- Ensure existing clients point to themselves
UPDATE users SET CLIENT_CODE = CODE WHERE TYPE = 'C' AND (CLIENT_CODE IS NULL OR CLIENT_CODE = '');
