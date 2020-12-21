-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 09:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikkha_deekkha`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `employee_id`, `job_title`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Utchas', 'utchas903@gmail.com', NULL, '$2y$10$JhyOYmXbFKIeb2cRYsNhE..ri373rp2RlY2oxN.O4zwrGAdTCXfLO', 1000001, 'Developer', 1521479924, NULL, 'BGuoSZc0flc8lrteIsklq3bZea2t1jfNSfURKRcnOGKbGyAaKye1IoIFxIvO', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(3, 'Eshan', 'eshan@gmail.com', NULL, '$2y$10$eC7z.PI1XvcNVdzBnTiuse.XkEBFqqp6EwuQ9evBOOhmBQvQCO2ba', 1000002, 'Developer', 1234567891, NULL, NULL, '2020-12-21 02:25:40', '2020-12-21 02:34:57'),
(4, 'Borshon', 'borshon@gmail.com', NULL, '$2y$10$XGulXTIn9wRNSKiGqhZULO1/B1z7jgBmYAAevqQjp1KPbb8BdbTqO', 1000003, 'Developer', 1234567892, NULL, NULL, '2020-12-21 02:26:09', '2020-12-21 02:35:07'),
(5, 'Masud Rana', 'masud@gmail.com', NULL, '$2y$10$o5dyJkV6yyfUJUayvEPjwuXk52/SCkFYKM1O.JzeVNHP1H0yvAsEi', 1000004, 'Developer', 1234567893, NULL, NULL, '2020-12-21 02:37:20', '2020-12-21 02:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'A Proggraming Language', 0, '2020-12-20 08:48:00', '2020-12-20 08:48:00'),
(2, 1, 'A Desktop Application', 1, '2020-12-20 08:48:00', '2020-12-20 08:48:00'),
(3, 1, 'A Game Engine', 1, '2020-12-20 08:48:00', '2020-12-20 08:48:00'),
(4, 1, 'An IDE', 0, '2020-12-20 08:48:00', '2020-12-20 08:48:00'),
(5, 2, 'Game Objects', 1, '2020-12-20 09:00:05', '2020-12-20 09:00:05'),
(6, 2, 'Unity Component', 0, '2020-12-20 09:00:05', '2020-12-20 09:00:05'),
(7, 2, 'C# Function', 0, '2020-12-20 09:00:05', '2020-12-20 09:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_marks` double(5,2) NOT NULL,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_peer_graded` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `module_id`, `title`, `description`, `total_marks`, `attachment_path`, `deadline`, `is_peer_graded`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 3, 'Quiz 1', '<p>Answer all the questions and <strong><em>upload your code</em></strong> for <strong>Question 5. </strong>There are some instructions for building your first WebGL project in the attached document.</p>', 0.00, 'storage/Space Wrap with Unity/Building and Distributing a Unity Web Player Game.pdf', '2020-12-27', 0, 1, '2020-12-20 08:47:06', '2020-12-20 09:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `module_id`, `title`, `type`, `description`, `web_link`, `video_link`, `file_path`, `is_protected`, `created_at`, `updated_at`) VALUES
(1, 1, 'Welcome to the course', 'Video', NULL, NULL, 'https://www.youtube.com/watch?v=LhrM5h3Xdqs', NULL, 0, '2020-12-20 08:32:47', '2020-12-20 08:32:47'),
(2, 1, 'What is Unity and why Unity?', 'Video', NULL, NULL, 'https://www.youtube.com/watch?v=4m5VgFCpmW4&t=5s', NULL, 0, '2020-12-20 08:33:18', '2020-12-20 08:33:18'),
(3, 2, 'Download Unity', 'Link', NULL, 'https://unity3d.com/get-unity/download', NULL, NULL, 0, '2020-12-20 08:34:46', '2020-12-20 08:34:46'),
(4, 2, 'Download Visual Studio', 'Link', NULL, 'https://visualstudio.microsoft.com/downloads/', NULL, NULL, 0, '2020-12-20 08:35:25', '2020-12-20 08:35:25'),
(5, 2, 'Unity Environment Setup', 'Video', '<p>Follow the tutorial to make the preset which will be followed throughout the whole course. Although you are free to experiment and create your own preset, we recommend to use the preset showed here for convenience.</p>', NULL, 'https://www.youtube.com/watch?v=_g1TyAGk6Lk&t=19s', NULL, 0, '2020-12-20 08:40:37', '2020-12-20 08:40:37'),
(6, 3, 'Scenes', 'Text', '<h1>Scenes</h1>\r\n\r\n<p>Scenes contain the environments and menus of your game. Think of each unique <strong>Scene</strong> file as a unique level. In each <strong>Scene</strong>, you place your environments, obstacles, and decorations, essentially designing and building your game in pieces.</p>\r\n\r\n<p><img alt=\"A new empty Scene, with the default 3D objects: a Main Camera and a directional Light\" src=\"https://docs.unity3d.com/2019.3/Documentation/uploads/Main/NewEmptyScene_01.png\" /></p>\r\n\r\n<p>A new empty Scene, with the default 3D objects: a Main Camera and a directional Light</p>\r\n\r\n<p>When you create a new Unity project, your <strong>scene view</strong><br />\r\ndisplays a new Scene. This Scene is <em>untitled</em> and <em>unsaved</em>. The Scene is empty except for a <strong>Camera</strong><br />\r\n(called <strong>Main Camera</strong>) and a Light (called <strong>Directional Light</strong>).</p>\r\n\r\n<h2>Saving Scenes</h2>\r\n\r\n<p>To save the Scene you&rsquo;re currently working on, choose <strong>File</strong> &gt; <strong>Save Scene</strong> from the menu, or press Ctrl + S (Windows) or Cmd + S (masOS).</p>\r\n\r\n<p>Unity saves Scenes as Assets in your project&rsquo;s <em>Assets</em> folder. This means they appear in the Project window, with the rest of your Assets.</p>\r\n\r\n<p><img alt=\"Saved Scene Assets visible in the Project window\" src=\"https://docs.unity3d.com/2019.3/Documentation/uploads/Main/SceneAssetsInProjectView_01.png\" /></p>\r\n\r\n<p>Saved Scene Assets visible in the Project window</p>\r\n\r\n<h2>Opening Scenes</h2>\r\n\r\n<p>To open a Scene in Unity, double-click the Scene Asset in the Project window. You must open a Scene in Unity to work on it.</p>\r\n\r\n<p>If your current Scene contains unsaved changes, Unity asks you whether you want to save or discard the changes.</p>\r\n\r\n<h2>Multi-Scene editing</h2>\r\n\r\n<p>It is possible to have multiple Scenes open for editing at one time. For more information about this, see documentation on <a href=\"https://docs.unity3d.com/2019.3/Documentation/Manual/MultiSceneEditing.html\">Multi-Scene editing</a>.</p>', NULL, NULL, NULL, 0, '2020-12-20 08:41:18', '2020-12-20 08:41:18'),
(7, 3, 'Sprites', 'Text', '<h1>Sprites</h1>\r\n\r\n<p><strong>Sprites</strong> are 2D Graphic objects. If you are used to working in 3D, <strong>Sprites</strong> are essentially just standard textures but there are special techniques for combining and managing sprite textures for efficiency and convenience during development.</p>\r\n\r\n<p>Unity provides a placeholder <a href=\"https://docs.unity3d.com/Manual/SpriteCreator.html\">Sprite Creator</a>, a built-in <a href=\"https://docs.unity3d.com/Manual/SpriteEditor.html\">Sprite Editor</a>, a <a href=\"https://docs.unity3d.com/Manual/class-SpriteRenderer.html\">Sprite Renderer</a><br />\r\nand a <a href=\"https://docs.unity3d.com/Manual/SpritePacker.html\">Sprite Packer</a></p>\r\n\r\n<p>See <strong>Importing and Setting up Sprites</strong> below for information on setting up assets as <strong>Sprites</strong> in your Unity project.</p>\r\n\r\n<h2>Sprite Tools</h2>\r\n\r\n<h3>Sprite Creator</h3>\r\n\r\n<p>Use the <a href=\"https://docs.unity3d.com/Manual/SpriteCreator.html\">Sprite Creator</a> to create placeholder sprites in your project, so you can carry on with development without having to source or wait for graphics.</p>\r\n\r\n<h3>Sprite Editor</h3>\r\n\r\n<p>The <a href=\"https://docs.unity3d.com/Manual/SpriteEditor.html\">Sprite Editor</a> lets you extract sprite graphics from a larger image and edit a number of component images within a single texture in your image editor. You could use this, for example, to keep the arms, legs and body of a character as separate elements within one image.</p>\r\n\r\n<h3>Sprite Renderer</h3>\r\n\r\n<p>Sprites are rendered with a <a href=\"https://docs.unity3d.com/Manual/class-SpriteRenderer.html\">Sprite Renderer</a> component rather than the <a href=\"https://docs.unity3d.com/Manual/class-MeshRenderer.html\">Mesh Renderer</a><br />\r\nused with <strong>3D objects</strong><br />\r\n. Use it to display images as <strong>Sprites</strong> for use in both 2D and 3D <strong>scenes</strong><br />\r\n.</p>\r\n\r\n<h3>Sprite Packer</h3>\r\n\r\n<p>Use <a href=\"https://docs.unity3d.com/Manual/SpritePacker.html\">Sprite Packer</a> to optimize the use and performance of video memory by your project.</p>\r\n\r\n<h2>Importing and Setting Up Sprites</h2>\r\n\r\n<p><strong>Sprites</strong> are a type of <strong>Asset</strong><br />\r\nin Unity projects. You can see them, ready to use, via the <strong>Project</strong><br />\r\nview.</p>\r\n\r\n<p>There are two ways to bring <strong>Sprites</strong> into your project:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>In your computer&rsquo;s Finder (Mac OS X) or File Explorer (Windows), place your image directly into your Unity Project&rsquo;s <strong>Assets</strong> folder.</p>\r\n\r\n	<p>Unity detects this and displays it in your project&rsquo;s <strong>Project</strong> view.</p>\r\n	</li>\r\n	<li>\r\n	<p>In Unity, go to <strong>Assets</strong> &gt; <strong>Import New Asset</strong> to bring up your computer&rsquo;s Finder (Mac OS X) or File Explorer (Windows).</p>\r\n\r\n	<p>From there, select the image you want, and Unity puts it in the <strong>Project</strong> view.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>See <a href=\"https://docs.unity3d.com/Manual/ImportingAssets.html\">Importing</a> for more details on this and important information about organising your <strong>Assets</strong> folder.</p>\r\n\r\n<h3>Setting your Image as a Sprite</h3>\r\n\r\n<p>If your project mode is set to 2D, the image you import is automatically set as a <strong>Sprite</strong>. For details on setting your project mode to 2D, see <a href=\"https://docs.unity3d.com/Manual/2Dor3D.html\">2D or 3D Projects</a>.</p>\r\n\r\n<p>However, if your project mode is set to 3D, your image is set as a <strong>Texture</strong><br />\r\n, so you need to change the asset&rsquo;s <strong>Texture Type</strong>:</p>\r\n\r\n<ol>\r\n	<li>Click on the asset to see its <strong>Import Inspector</strong>.</li>\r\n	<li>Set the <strong>Texture Type</strong> to <strong>Sprite (2D and UI)</strong>:</li>\r\n</ol>\r\n\r\n<p><img alt=\"Set Texture Type to Sprite (2D and UI) in the Assets Inspector\" src=\"https://docs.unity3d.com/uploads/Main/TextureTypeSprite.png\" /></p>\r\n\r\n<p>Set Texture Type to Sprite (2D and UI) in the Asset&rsquo;s Inspector</p>\r\n\r\n<p>For details on Sprite <strong>Texture Type</strong> settings, see <a href=\"https://docs.unity3d.com/Manual/TextureTypes.html#Sprite\" target=\"_blank\">Texture type: Sprite (2D and UI)</a>.</p>\r\n\r\n<h2>Sorting Sprites</h2>\r\n\r\n<p>Renderers in Unity are sorted by several criteria, such as their Layer order or their distance from the Camera. Unity&rsquo;s GraphicsSettings (menu: <strong>Edit</strong> &gt; <strong>Project Settings</strong><br />\r\n, then select the <strong>Graphics</strong> category) provide a setting called <strong>Transparency Sort Mode</strong>, which allows you to control how Sprites are sorted depending on where they are in relation to the Camera. More specifically, it uses the Sprite&rsquo;s position on an axis to determine which ones are transparent against others, and which are not.</p>\r\n\r\n<p>An example of when you might use this setting is to sort Sprites along the Y axis. This is quite common in 2D games, where Sprites that are higher up are sorted behind Sprites that are lower, to make them appear further away.</p>\r\n\r\n<p><img alt=\"\" src=\"https://docs.unity3d.com/uploads/Main/AxisDistanceSort2.png\" /></p>\r\n\r\n<p>There are four <strong>Transparency Sort Mode</strong> options available:</p>\r\n\r\n<p><img alt=\"\" src=\"https://docs.unity3d.com/uploads/Main/AxisDistanceSort.png\" /></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Default</strong> - Sorts based on whether the <strong>Camera</strong><br />\r\n	&rsquo;s <strong>Projection</strong> mode is set to <strong>Perspective</strong> or <strong>Orthographic</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Perspective</strong> - Sorts based on perspective view. Perspective view sorts Sprites based on the distance from the Camera&rsquo;s position to the Sprite&rsquo;s center.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Orthographic</strong> - Sorts based on orthographic view. Orthographic view sorts Sprites based on the distance along the view direction.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Custom Axis</strong> - Sorts based on the given axis set in Transparency Sort Axis</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>If you have set the <strong>Transparency Sort Mode</strong> to <strong>Custom</strong>, you then need to set the <strong>Transparency Sort Axis</strong>:</p>\r\n\r\n<p><img alt=\"\" src=\"https://docs.unity3d.com/uploads/Main/AxisDistanceSort1.png\" /></p>\r\n\r\n<p>If the <strong>Transparency Sort Mode</strong> is set to <strong>Custom Axis</strong>, renderers in the <strong>Scene view</strong><br />\r\nare sorted based on the distance of this axis from the camera. Use a value between &ndash;1 and 1 to define the axis. For example: X=0, Y=1, Z=0 sets the axis direction to up. X=1, Y=1, Z=0 sets the axis to a diagonal direction between X and Y.</p>\r\n\r\n<p>For example, if you want Sprites to behave like the ones in the image above (those higher up the y axis standing behind the Sprites that are lower on the axis), set the <strong>Transparency Sort Mode</strong> to <strong>Custom Axis</strong>, and set the <strong>Y</strong> value for the <strong>Transparency Sort Axis</strong> to a value higher than 0.</p>\r\n\r\n<h2>Sorting Sprites using script</h2>\r\n\r\n<p>You can also sort Sprites per camera through <strong>scripts</strong><br />\r\n, by modifying the following properties in Camera:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><a href=\"https://docs.unity3d.com/ScriptReference/Camera-transparencySortMode.html\">TransparencySortMode</a> (corresponds with <strong>Transparency Sort Mode</strong>)</p>\r\n	</li>\r\n	<li>\r\n	<p><a href=\"https://docs.unity3d.com/ScriptReference/Camera-transparencySortAxis.html\">TransparencySortAxis</a> (corresponds with <strong>Transparency Sort Axis</strong>)</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>For example:</p>\r\n\r\n<pre>\r\n<code>var camera = GetComponent&lt;Camera&gt;();\r\n\r\ncamera.transparencySortMode = TransparencySortMode.CustomAxis;\r\n\r\ncamera.transparencySortAxis = new Vector3(0.0f, 1.0f, 0.0f);\r\n</code></pre>', NULL, NULL, NULL, 0, '2020-12-20 08:42:11', '2020-12-20 08:42:11'),
(8, 3, 'Prefabs', 'Text', '<h1>Prefabs</h1>\r\n\r\n<p><img alt=\"\" src=\"https://docs.unity3d.com/uploads/Main/PrefabsIntroScene.png\" /></p>\r\n\r\n<p>Unity&rsquo;s <strong><strong>Prefab</strong></strong> system allows you to create, configure, and store a GameObject complete with all its components, property values, and child <strong>GameObjects</strong><br />\r\nas a reusable Asset. The <strong>Prefab</strong> Asset acts as a template from which you can create new <strong>Prefab</strong> instances in the <strong>Scene</strong><br />\r\n.</p>\r\n\r\n<p>When you want to reuse a GameObject configured in a particular way &ndash; like a non-player character (NPC), prop or piece of scenery &ndash; in multiple places in your Scene, or across multiple Scenes in your Project, you should convert it to a Prefab. This is better than simply copying and pasting the GameObject, because the Prefab system allows you to automatically keep all the copies in sync.</p>\r\n\r\n<p>Any edits that you make to a Prefab Asset are automatically reflected in the instances of that Prefab, allowing you to easily make broad changes across your whole Project without having to repeatedly make the same edit to every copy of the Asset.</p>\r\n\r\n<p>You can <a href=\"https://docs.unity3d.com/Manual/NestedPrefabs.html\">nest Prefabs</a> inside other Prefabs to create complex hierarchies of objects that are easy to edit at multiple levels.</p>\r\n\r\n<p>However, this does not mean all Prefab instances have to be identical. You can <a href=\"https://docs.unity3d.com/Manual/PrefabInstanceOverrides.html\">override</a> settings on individual prefab instances if you want some instances of a Prefab to differ from others. You can also create <a href=\"https://docs.unity3d.com/Manual/PrefabVariants.html\">variants</a> of Prefabs which allow you to group a set of overrides together into a meaningful variation of a Prefab.</p>\r\n\r\n<p>You should also use Prefabs when you want to <a href=\"https://docs.unity3d.com/Manual/InstantiatingPrefabs.html\">instantiate GameObjects at runtime</a> that did not exist in your Scene at the start - for example, to make powerups, special effects, projectiles, or NPCs appear at the right moments during gameplay.</p>\r\n\r\n<p>Some common examples of Prefab use include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Environmental Assets - for example a certain type of tree used multiple times around a level (as seen in the screenshot above).</p>\r\n	</li>\r\n	<li>\r\n	<p>Non-player characters (NPCs) - for example a certain type of robot may appear in your game multiple times, across multiple levels. They may differ (using <em>overrides</em>) in the speed they move, or the sound they make.</p>\r\n	</li>\r\n	<li>\r\n	<p>Projectiles - for example a pirate&rsquo;s cannon might instantiate a cannonball Prefab each time it is fired.</p>\r\n	</li>\r\n	<li>\r\n	<p>The player&rsquo;s main character - the player prefab might be placed at the starting point on each level (separate Scenes) of your game.</p>\r\n	</li>\r\n</ul>', NULL, NULL, NULL, 0, '2020-12-20 08:43:14', '2020-12-20 08:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `syllabus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prerequisites` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_outcome` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_starting` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_id` bigint(20) UNSIGNED DEFAULT NULL,
  `has_certificate` tinyint(1) NOT NULL DEFAULT 0,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `total_marks` double(5,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `completion_marks` int(10) UNSIGNED DEFAULT NULL,
  `fee` decimal(7,2) UNSIGNED DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `subtitle`, `level`, `difficulty`, `duration`, `subject_id`, `topic`, `description`, `syllabus`, `prerequisites`, `expected_outcome`, `image_path`, `date_starting`, `institution_id`, `has_certificate`, `is_paid`, `total_marks`, `completion_marks`, `fee`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Space Wrap with Unity', 'Learn to make exciting games in most popular game engine Unity without any prior knowledge on game development.', 'Undergraduate', 'Beginner', '3 Weeks', 4, 'Game Development', '<p>This course is intended for beginners interested in game development with no prior knowledge.\n                                Through the course student will learn about basics of not only Unity programming but also other components of Unity.\n                                Prior knowledge of object oriented programming will be helpful but not required.\n                                At the end of the course, a real fully functional 2D game will be built.\n                                Although this course will not cover building graphics assets for the game.</p>', '<ul>\n                                <li>Introduction</li>\n                                <li>Unity Setup with Visual Studio as default code editor</li>\n                                <li>Scenes, Assets, Scripts, Sprites, Prefabs</li>\n                                <li>Basic Script</li>\n                                <li>Rigid Bodies &amp; Colliders</li>\n                                <li>Timers, Awake &amp; Start</li>\n                                <li>Update &amp; Fixed Update</li>\n                                <li>Classes &amp; Objects</li>\n                                <li>Spawning &amp; Destroying</li>\n                                <li>Forces, Angles and Direction</li>\n                                <li>Building the Game</li>\n                            </ul>', '<p>Knowledge of:&nbsp;</p>\n\n                                    <ol>\n                                        <li>Basic Maths</li>\n                                        <li>Basic Physics</li>\n                                        <li>Basic Programming</li>\n                                        <li>Object Oriented Programming Concept</li>\n                                    </ol>', '<p>Learn to make 2D games with Unity developing a real indie game.</p>', 'storage/CourseImage/AqliwkBr9JyfsaiEwzUftnheNaZOYb7vjDBEgi3Y.jpg', '2020-12-01', NULL, 1, 0, 0.00, 70, NULL, NULL, '2020-12-20 08:29:20', '2020-12-20 09:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor`
--

CREATE TABLE `course_instructor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_instructor`
--

INSERT INTO `course_instructor` (`id`, `course_id`, `instructor_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `total_marks_obtained` double(5,2) NOT NULL DEFAULT 0.00,
  `has_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_student`
--

INSERT INTO `course_student` (`id`, `course_id`, `student_id`, `total_marks_obtained`, `has_completed`, `created_at`, `updated_at`) VALUES
(11, 1, 1, 0.00, 0, NULL, NULL),
(12, 1, 2, 0.00, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_level_lower` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `study_level_upper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `email`, `phone`, `address`, `study_level_lower`, `study_level_upper`, `logo_path`, `created_at`, `updated_at`) VALUES
(3, 'Daffodil International University', 'info@daffodilvarsity.edu.bd', 1234567890, NULL, 'Diploma', 'Post-Graduate', 'storage/Institution/Daffodil-International-University-DIU-logo.png', '2020-12-21 00:47:18', '2020-12-21 00:47:18'),
(4, 'Rajuk Uttara Model  College', 'rumc1994@yahoo.com', 1234567891, NULL, 'High School', 'Higher Secondary', NULL, '2020-12-21 00:51:22', '2020-12-21 00:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `UUID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `institution_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `UUID`, `name`, `email`, `email_verified_at`, `password`, `designation`, `department`, `institution`, `phone`, `address`, `about`, `is_verified`, `institution_id`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2c82be2a-b36b-4e0e-a779-c22997726768', 'Md. Kamrul Haque', 'utchas4@yahoo.com', NULL, '$2y$10$lJyUKkSSrNqxOeTBUEL9pu2LOInVPt4FnbGGq.iDGz2RalnoLrk7O', 'Lecturer', 'SWE', 'DIU', 1521479924, NULL, '7 years of experience in Game Development', 0, NULL, NULL, 'W0qCFkCUHVVwhtFxUReM9v6NXRP1gtFjeRSNfpwlh9ZnD9DfgMrsntmk4GtX', '2020-12-20 08:29:20', '2020-12-20 08:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_08_092716_create_students_table', 1),
(5, '2020_10_20_142150_create_institutions_table', 1),
(6, '2020_11_03_141856_create_instructors_table', 1),
(7, '2020_11_16_070757_create_admins_table', 1),
(8, '2020_11_18_162959_create_subjects_table', 1),
(9, '2020_11_19_150830_create_courses_table', 1),
(10, '2020_11_26_191917_create_modules_table', 1),
(11, '2020_11_27_095755_create_course_instructor_table', 1),
(12, '2020_11_27_152248_create_course_student_table', 1),
(13, '2020_12_06_071440_create_contents_table', 1),
(14, '2020_12_14_142842_create_assessments_table', 1),
(15, '2020_12_15_071149_create_questions_table', 1),
(16, '2020_12_15_123105_create_answers_table', 1),
(17, '2020_12_18_073051_create_responses_table', 1),
(18, '2020_12_19_071601_create_response_answers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Introduction', 1, '2020-12-07 08:15:46', '2020-12-07 08:15:57'),
(2, 'Unity setup with Visual Studio', 1, '2020-12-07 08:16:16', '2020-12-07 08:16:16'),
(3, 'Unity Components', 1, '2020-12-07 08:16:22', '2020-12-07 08:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` double(5,2) NOT NULL,
  `needs_review` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `assessment_id`, `type`, `question`, `marks`, `needs_review`, `created_at`, `updated_at`) VALUES
(1, 1, 'MCQ', 'What is Unity?', 5.00, 0, '2020-12-20 08:48:00', '2020-12-20 08:48:00'),
(2, 1, 'MCQ', 'Prefabs are?', 2.50, 0, '2020-12-20 09:00:05', '2020-12-20 09:00:05'),
(3, 1, 'Short Question', 'What is the function of Awake method?', 5.00, 1, '2020-12-20 09:05:02', '2020-12-20 09:05:02'),
(4, 1, 'Descriptive', 'Describe Unity Components', 10.00, 1, '2020-12-20 09:05:20', '2020-12-20 09:05:20'),
(5, 1, 'File Submission', 'Submit your code', 20.00, 1, '2020-12-20 09:08:43', '2020-12-20 09:08:43'),
(6, 1, 'Link Submission', 'Submit your Unity webGL link', 25.00, 1, '2020-12-20 09:08:56', '2020-12-20 09:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `obtained_marks` double(5,2) DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `question_id`, `student_id`, `obtained_marks`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2.50, 1, '2020-12-20 09:11:55', '2020-12-20 09:11:55'),
(2, 1, 1, 0.00, 0, '2020-12-20 09:12:02', '2020-12-20 09:12:02'),
(3, 3, 1, 0.00, 0, '2020-12-20 09:12:36', '2020-12-20 09:39:14'),
(4, 5, 1, NULL, 0, '2020-12-20 09:12:57', '2020-12-20 09:12:57'),
(5, 1, 2, 5.00, 1, '2020-12-20 09:21:40', '2020-12-20 09:21:40'),
(6, 2, 2, 2.50, 1, '2020-12-20 09:21:46', '2020-12-20 09:21:46'),
(7, 3, 2, 5.00, 0, '2020-12-20 09:22:12', '2020-12-20 09:39:38'),
(8, 5, 2, NULL, 0, '2020-12-20 09:22:44', '2020-12-20 09:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `response_answers`
--

CREATE TABLE `response_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `response_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `response_answers`
--

INSERT INTO `response_answers` (`id`, `response_id`, `answer`, `attachment_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Game Objects', NULL, '2020-12-20 09:11:55', '2020-12-20 09:11:55'),
(2, 2, 'A Game Engine', NULL, NULL, NULL),
(3, 3, 'Runs at the start of every frame', NULL, '2020-12-20 09:12:36', '2020-12-20 09:12:36'),
(4, 4, NULL, 'storage/Space Wrap with Unity/Timer.cs', '2020-12-20 09:12:57', '2020-12-20 09:12:57'),
(5, 5, 'A Desktop Application', NULL, NULL, NULL),
(6, 5, 'A Game Engine', NULL, NULL, NULL),
(7, 6, 'Game Objects', NULL, '2020-12-20 09:21:46', '2020-12-20 09:21:46'),
(8, 7, 'Runs at the start of game', NULL, '2020-12-20 09:22:12', '2020-12-20 09:22:12'),
(9, 8, NULL, 'storage/Space Wrap with Unity/Program.cs', '2020-12-20 09:22:44', '2020-12-20 09:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `study_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interests` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `email_verified_at`, `password`, `study_level`, `institution`, `specialization`, `phone`, `address`, `interests`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Masud Rana', 'masud@gmail.com', NULL, '$2y$10$/RwOlYsuI9q0Emo/iFNb.OOlkJ7MdmZ41aS6LqPuT3E0uhnqGJiwu', 'Undergraduate', 'DIU', 'B.Sc. in SWE', NULL, NULL, 'Web Development', NULL, 'aQ3ds64u9yLAodPpLHc2Nh90kDHHOtzt3A1bREBIG7Inz6mmAI0e3f32LpDF', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(2, 'Tariqul Islam', 'tariqul@gmail.com', NULL, '$2y$10$QGx/Vk.P8Ya7hn0vhDhDvOhj7qtFw6EMCMfBgq11NgChujlzUzlWm', 'Undergraduate', 'MIU', 'B.Sc. in CSE', 1521214410, NULL, 'Game Development', NULL, NULL, '2020-12-20 09:21:04', '2020-12-20 09:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 'Physics', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(2, 'Chemistry', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(3, 'Biology', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(4, 'Computer Science', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(5, 'Software Engineering', '2020-12-21 01:19:40', '2020-12-21 01:19:40'),
(6, 'Data Science', '2020-12-21 01:19:56', '2020-12-21 01:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessments_module_id_foreign` (`module_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contents_module_id_foreign` (`module_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_title_unique` (`title`),
  ADD KEY `courses_institution_id_foreign` (`institution_id`),
  ADD KEY `courses_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_instructor_course_id_foreign` (`course_id`),
  ADD KEY `course_instructor_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_student_course_id_foreign` (`course_id`),
  ADD KEY `course_student_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institutions_email_unique` (`email`),
  ADD UNIQUE KEY `institutions_phone_unique` (`phone`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructors_email_unique` (`email`),
  ADD UNIQUE KEY `instructors_phone_unique` (`phone`),
  ADD KEY `instructors_institution_id_foreign` (`institution_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_course_id_foreign` (`course_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_question_id_foreign` (`question_id`),
  ADD KEY `responses_student_id_foreign` (`student_id`);

--
-- Indexes for table `response_answers`
--
ALTER TABLE `response_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_answers_response_id_foreign` (`response_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_subject_name_unique` (`subject_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_instructor`
--
ALTER TABLE `course_instructor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `response_answers`
--
ALTER TABLE `response_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`),
  ADD CONSTRAINT `courses_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD CONSTRAINT `course_instructor_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_instructor_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `response_answers`
--
ALTER TABLE `response_answers`
  ADD CONSTRAINT `response_answers_response_id_foreign` FOREIGN KEY (`response_id`) REFERENCES `responses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
