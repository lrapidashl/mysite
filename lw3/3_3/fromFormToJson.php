<?php
$fileName = 'data.json';
$imagePath = "images/";
$uniqErr = '';
$imgErr = '';

function isUserUniq(string $fileName, string $id): bool
{
    if (!file_get_contents($fileName))
    {
        return true;
    }
    else
    {
        $json = file_get_contents($fileName);
        $users = json_decode($json); 
        foreach ($users as $key => $value)
        {
            if ($key === $id)
            {
                return false;
            }
        }
        return true;
    }
}

if (array_count_values($err)[''] === count($err) && isset($_POST))
{
    $file = fopen($fileName, 'a');
    $id = hash('md5', $_POST['email']) . hash('md5', $_POST['telephone']);
    if(is_uploaded_file($_FILES['avatar']['tmp_name']) && file_exists($imagePath))
    {
        $imageName = basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $imagePath . $imageName);
    }
    else
    {
        $imgErr = "Не удалось загрузить аватар";
        return;
    }
    
    if (isUserUniq($fileName, $id))
    {   
        if ($imgErr === '')
        {
            $_POST['avatar'] = $imageName;
        }
        $json = json_encode($_POST, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if (fstat($file)['size'] !== 0)
        {
            ftruncate($file, fstat($file)['size'] - 2);
            fwrite($file, ',' . "\n");
        }
        else
        {
            fwrite($file, '{' . "\n");
        }

        fwrite($file, '"' . $id . '"' . ':'. $json . "\n" . '}');
    }
    else
    {
        $uniqErr = 'Пользователь уже существует';
    }

    fclose($file);
}


