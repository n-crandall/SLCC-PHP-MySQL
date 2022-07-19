<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Week 2</title>
</head>
<body>
    <header>
        <h1>About Me</h1>
    </header>
    <section>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero iusto at dolore accusantium eveniet quod, unde dicta doloremque. Ad ex magni commodi aliquid officia labore quae veritatis at similique amet.</p>
    </section>
    <?php

        function skillsList($str, $arr) {
            echo "<strong>$str</strong>";
            echo "<ol>";
            foreach ($arr as $a) {
                echo "<li>$a</li>";
              }
            echo "</ol>";
        }

        $skills = array("HTML", "CSS", "JavaScript", "Bootstrap", "ReactJS");
        skillsList("My skills include: ", $skills);

    ?>
    <section>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde nemo numquam tempora aut, error modi libero sed, consequuntur possimus minus animi repudiandae quae! Voluptate id quibusdam doloremque minus dolorum atque.</p>
    </section>
</body>
</html>