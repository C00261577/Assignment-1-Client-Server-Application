<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$text = '';

if (isset($_POST['subject'], $_POST['email'], $_POST['text'])) {
    
    if (empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['text'])) {
        $text = 'Please enter your query ';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $text = 'Please provide a valid email address!';
    } else {
        
        $stmt = $pdo->prepare('INSERT INTO tickets (subject, email, text) VALUES (?, ?, ?)');
        $stmt->execute([ $_POST['subject'], $_POST['email'], $_POST['text'] ]);
        header('Location: view.php?id=' . $pdo->lastInsertId());
        exit;
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
	<h2>Create Ticket</h2>
    <form action="create.php" method="post">
        <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Subject" id="subject" required>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="JediNight@example.com" id="email" required>
        <label for="text">Message</label>
        <textarea name="text" placeholder="Enter your Query here..." id="text" required></textarea>
        <input type="submit" value="Create">
    </form>
    <?php if ($text): ?>
    <p><?=$text?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>