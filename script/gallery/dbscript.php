CREATE TABLE  `user_uploads` (
`upload_id` int(11) AUTO_INCREMENT PRIMARY KEY,
`image_name` text,
`user_id_fk` int(11),
`created` int(11)
)