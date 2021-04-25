-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 09:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
(1, 'Utchas', 'utchas903@gmail.com', NULL, '$2y$10$JhyOYmXbFKIeb2cRYsNhE..ri373rp2RlY2oxN.O4zwrGAdTCXfLO', 1000001, 'Developer', 1521479924, NULL, 'sNnSJIZ6m8zoifPZiAzRVtMGEU73olvaA9JGSdNiFEex5hx9hYLIXCc66hQx', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(3, 'Eshan', 'eshan@gmail.com', NULL, '$2y$10$eC7z.PI1XvcNVdzBnTiuse.XkEBFqqp6EwuQ9evBOOhmBQvQCO2ba', 1000002, 'Developer', 1234567891, NULL, NULL, '2020-12-21 02:25:40', '2020-12-21 02:34:57'),
(4, 'Borshon', 'borshon@gmail.com', NULL, '$2y$10$XGulXTIn9wRNSKiGqhZULO1/B1z7jgBmYAAevqQjp1KPbb8BdbTqO', 1000003, 'Developer', 1234567892, NULL, NULL, '2020-12-21 02:26:09', '2020-12-21 02:35:07'),
(5, 'Masud Rana', 'masud@gmail.com', NULL, '$2y$10$o5dyJkV6yyfUJUayvEPjwuXk52/SCkFYKM1O.JzeVNHP1H0yvAsEi', 1000004, 'Developer', 1234567893, NULL, NULL, '2020-12-21 02:37:20', '2020-12-21 02:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `course_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'Please keep the environment respectful & helpful throughout the whole course.', '2021-04-22 10:48:02', '2021-04-22 10:48:02'),
(2, 1, 'Post you queries & problems in the Course Discussion Panel. Also try to help others.', '2021-04-22 10:48:51', '2021-04-22 10:48:51');

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
(1, 3, 'Quiz 1', '<p>Answer all the questions and <strong><em>upload your code</em></strong> for <strong>Question 5. </strong>There are some instructions for building your first WebGL project in the attached document.</p>', 0.00, 'storage/Space Wrap with Unity/Building and Distributing a Unity Web Player Game.pdf', '2020-12-27', 0, 1, '2020-12-20 08:47:06', '2020-12-20 09:09:08'),
(4, 3, 'Quiz 2', '<p>This is quiz 2</p>', 0.00, NULL, '2021-03-26', 0, 0, '2021-03-19 10:43:54', '2021-03-19 10:43:54');

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
(8, 3, 'Prefabs', 'Text', '<h1>Prefabs</h1>\r\n\r\n<p><img alt=\"\" src=\"https://docs.unity3d.com/uploads/Main/PrefabsIntroScene.png\" /></p>\r\n\r\n<p>Unity&rsquo;s <strong><strong>Prefab</strong></strong> system allows you to create, configure, and store a GameObject complete with all its components, property values, and child <strong>GameObjects</strong><br />\r\nas a reusable Asset. The <strong>Prefab</strong> Asset acts as a template from which you can create new <strong>Prefab</strong> instances in the <strong>Scene</strong><br />\r\n.</p>\r\n\r\n<p>When you want to reuse a GameObject configured in a particular way &ndash; like a non-player character (NPC), prop or piece of scenery &ndash; in multiple places in your Scene, or across multiple Scenes in your Project, you should convert it to a Prefab. This is better than simply copying and pasting the GameObject, because the Prefab system allows you to automatically keep all the copies in sync.</p>\r\n\r\n<p>Any edits that you make to a Prefab Asset are automatically reflected in the instances of that Prefab, allowing you to easily make broad changes across your whole Project without having to repeatedly make the same edit to every copy of the Asset.</p>\r\n\r\n<p>You can <a href=\"https://docs.unity3d.com/Manual/NestedPrefabs.html\">nest Prefabs</a> inside other Prefabs to create complex hierarchies of objects that are easy to edit at multiple levels.</p>\r\n\r\n<p>However, this does not mean all Prefab instances have to be identical. You can <a href=\"https://docs.unity3d.com/Manual/PrefabInstanceOverrides.html\">override</a> settings on individual prefab instances if you want some instances of a Prefab to differ from others. You can also create <a href=\"https://docs.unity3d.com/Manual/PrefabVariants.html\">variants</a> of Prefabs which allow you to group a set of overrides together into a meaningful variation of a Prefab.</p>\r\n\r\n<p>You should also use Prefabs when you want to <a href=\"https://docs.unity3d.com/Manual/InstantiatingPrefabs.html\">instantiate GameObjects at runtime</a> that did not exist in your Scene at the start - for example, to make powerups, special effects, projectiles, or NPCs appear at the right moments during gameplay.</p>\r\n\r\n<p>Some common examples of Prefab use include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Environmental Assets - for example a certain type of tree used multiple times around a level (as seen in the screenshot above).</p>\r\n	</li>\r\n	<li>\r\n	<p>Non-player characters (NPCs) - for example a certain type of robot may appear in your game multiple times, across multiple levels. They may differ (using <em>overrides</em>) in the speed they move, or the sound they make.</p>\r\n	</li>\r\n	<li>\r\n	<p>Projectiles - for example a pirate&rsquo;s cannon might instantiate a cannonball Prefab each time it is fired.</p>\r\n	</li>\r\n	<li>\r\n	<p>The player&rsquo;s main character - the player prefab might be placed at the starting point on each level (separate Scenes) of your game.</p>\r\n	</li>\r\n</ul>', NULL, NULL, NULL, 0, '2020-12-20 08:43:14', '2020-12-20 08:43:14'),
(9, 2, 'Written Guide', 'File', NULL, NULL, NULL, 'storage/Space Wrap with Unity/Development Environment Setup.pdf', 0, '2020-12-22 18:43:33', '2020-12-22 18:43:33');

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
(1, 'Space Wrap with Unity', 'Learn to make exciting games in most popular game engine Unity without any prior knowledge on game development.', 'Undergraduate', 'Beginner', '3 Weeks', 4, 'Game Development', '<p>This course is intended for beginners interested in game development with no prior knowledge.\n                                Through the course student will learn about basics of not only Unity programming but also other components of Unity.\n                                Prior knowledge of object oriented programming will be helpful but not required.\n                                At the end of the course, a real fully functional 2D game will be built.\n                                Although this course will not cover building graphics assets for the game.</p>', '<ul>\n                                <li>Introduction</li>\n                                <li>Unity Setup with Visual Studio as default code editor</li>\n                                <li>Scenes, Assets, Scripts, Sprites, Prefabs</li>\n                                <li>Basic Script</li>\n                                <li>Rigid Bodies &amp; Colliders</li>\n                                <li>Timers, Awake &amp; Start</li>\n                                <li>Update &amp; Fixed Update</li>\n                                <li>Classes &amp; Objects</li>\n                                <li>Spawning &amp; Destroying</li>\n                                <li>Forces, Angles and Direction</li>\n                                <li>Building the Game</li>\n                            </ul>', '<p>Knowledge of:&nbsp;</p>\n\n                                    <ol>\n                                        <li>Basic Maths</li>\n                                        <li>Basic Physics</li>\n                                        <li>Basic Programming</li>\n                                        <li>Object Oriented Programming Concept</li>\n                                    </ol>', '<p>Learn to make 2D games with Unity developing a real indie game.</p>', 'storage/CourseImage/VL6LTl4Q7WEP0KxzaBu6BFarprz5JCgofaqZT5uW.jpg', '2020-12-01', 3, 1, 1, 0.00, 70, '700.00', 'BDT', '2020-12-20 08:29:20', '2021-04-20 15:20:09'),
(2, 'Atomic Structure Fundamentals', 'This course targets to satisfy the curiosity of students passionate about atomic physics or chemistry.', 'Higher Secondary', 'Advanced', '5 Weeks', 1, 'Atomic Structure', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<ul>\r\n	<li>Aenean elementum massa ac dapibus ultricies.</li>\r\n	<li>Praesent fermentum ex sit amet commodo molestie.</li>\r\n	<li>Donec sagittis lacus id enim varius, et lobortis sem hendrerit.</li>\r\n	<li>Sed sagittis mi ut ultricies pellentesque.</li>\r\n</ul>', '<ul>\r\n	<li>Curabitur vitae lectus tincidunt, bibendum dui quis, tristique est.</li>\r\n	<li>Aliquam pharetra ex in massa ullamcorper, non ullamcorper risus consequat.</li>\r\n	<li>Nullam auctor nisl nec lacus elementum dictum.</li>\r\n</ul>', '<ul>\r\n	<li>Cras et libero dignissim, mollis nunc et, volutpat felis.</li>\r\n	<li>Vestibulum vel magna vel dolor tempus pulvinar.</li>\r\n	<li>Etiam vulputate est iaculis justo pharetra, eu consectetur mi ultrices.</li>\r\n	<li>Sed eu purus non massa faucibus mattis.</li>\r\n</ul>', 'storage/CourseImage/5eMhfPJw20dVSQmqe7q45cP5P6C9ThQ0ZnQxVSUz.jpg', '2020-12-30', 5, 0, 0, 0.00, 70, NULL, NULL, '2020-12-22 22:26:57', '2021-04-23 19:13:23'),
(3, 'IELTS Made Easy', 'This course targets to prepare students for a good score in IELTS(academic) all for free.', 'Higher Secondary', 'Intermediate', '6 Weeks', 8, 'IELTS Preperation', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<ul>\r\n	<li>Phasellus sed lectus eu odio mattis suscipit vel at tellus.</li>\r\n	<li>Vivamus feugiat quam nec rhoncus euismod.</li>\r\n	<li>Nulla eget massa tempor, ultrices neque non, feugiat diam.</li>\r\n	<li>Aenean a nulla sed ligula efficitur vestibulum.</li>\r\n	<li>Maecenas pellentesque tellus vel ante sagittis, id ullamcorper sem commodo.</li>\r\n</ul>', '<ul>\r\n	<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n	<li>Quisque fermentum nisi eget hendrerit rutrum.</li>\r\n	<li>Vivamus sit amet lacus eget purus dignissim ornare suscipit vitae ante.</li>\r\n</ul>', '<ul>\r\n	<li>Nam congue erat vel turpis eleifend, sit amet congue dolor auctor.</li>\r\n	<li>Pellentesque ut ante in leo dapibus lobortis ut a nibh.</li>\r\n	<li>Sed bibendum lacus ut sem pulvinar consectetur.</li>\r\n	<li>Donec ut orci nec tellus luctus ornare.</li>\r\n	<li>Sed aliquet sapien sed tortor gravida, sit amet consequat justo maximus.</li>\r\n</ul>', 'storage/CourseImage/FM0G5Kdr61fFWHHx8dBqoStOQrjfqG9knCpTqMmL.jpg', '2020-12-30', 4, 0, 1, 0.00, 70, '500.00', 'BDT', '2020-12-23 07:09:26', '2021-04-23 19:13:55'),
(4, 'Test Course', 'This is a test course.', 'Post-Graduate', 'Expert', '99 Months', 3, 'Test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<ul>\r\n	<li>Nulla porta neque non maximus congue.</li>\r\n	<li>Ut viverra justo at bibendum venenatis.</li>\r\n	<li>Integer et lorem vulputate, dictum elit eget, cursus tellus.</li>\r\n	<li>Sed tempus mi et risus facilisis blandit.</li>\r\n	<li>Duis bibendum diam quis ipsum fermentum hendrerit.</li>\r\n</ul>', '<ul>\r\n	<li>Donec faucibus diam nec turpis vehicula, at fermentum justo rutrum.</li>\r\n	<li>Cras consectetur tellus eget eros sodales, non vestibulum mauris egestas.</li>\r\n	<li>Aenean dignissim risus sit amet purus tincidunt, sit amet molestie justo volutpat.</li>\r\n</ul>', '<ul>\r\n	<li>Phasellus et metus ac nunc hendrerit convallis quis nec tellus.</li>\r\n	<li>Aenean eget leo at tellus laoreet viverra sit amet in tellus.</li>\r\n	<li>Morbi imperdiet enim elementum, cursus quam a, blandit metus.</li>\r\n	<li>Nam sed mi in erat blandit mattis.</li>\r\n</ul>', NULL, '2021-01-04', NULL, 0, 0, 0.00, 100, NULL, NULL, '2020-12-28 09:15:15', '2021-03-19 10:49:56');

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
(4, 1, 2, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 3, 3, NULL, NULL),
(8, 2, 2, NULL, NULL),
(11, 1, 3, NULL, NULL);

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
(12, 1, 2, 0.00, 0, NULL, NULL),
(25, 2, 1, 0.00, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discussion_panels`
--

CREATE TABLE `discussion_panels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussion_panels`
--

INSERT INTO `discussion_panels` (`id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(4, 4, NULL, NULL);

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
(3, 'Daffodil International University', 'info@daffodilvarsity.edu.bd', 1234567890, 'Khagan, Birulia, Savar, Dhaka.', 'Diploma', 'Post-Graduate', 'storage/Institution/Daffodil-International-University-DIU-logo.png', '2020-12-21 00:47:18', '2021-04-23 19:16:41'),
(4, 'Rajuk Uttara Model  College', 'rumc1994@yahoo.com', 1234567891, 'Sector:6, Uttara, Dhaka-1230', 'High School', 'Higher Secondary', 'storage/Institution/RAJUK_Uttara_Model_College_logo.jpg', '2020-12-21 00:51:22', '2020-12-23 06:56:33'),
(5, 'Khulna University', 'info@ku.edu.bd', 1234567893, 'Sher-E-Bangla Road, Gollamari, Khulna', 'Undergraduate', 'Post-Graduate', 'storage/Institution/220px-Khulna_University_Logo.svg.png', '2020-12-23 06:59:45', '2020-12-23 06:59:45');

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
(1, '2c82be2a-b36b-4e0e-a779-c22997726768', 'Md. Kamrul Haque', 'utchas4@yahoo.com', NULL, '$2y$10$lJyUKkSSrNqxOeTBUEL9pu2LOInVPt4FnbGGq.iDGz2RalnoLrk7O', 'Lecturer', 'SWE', 'DIU', 1521479924, NULL, '7 years of experience in Game Development', 0, NULL, NULL, 'JJvRGHoUcCiaMPaAhxNkbnkMW9m4HUlj4OHthzi8YlKg6k5SKc0Pg2WUh5Bq', '2020-12-20 08:29:20', '2020-12-20 08:29:20'),
(2, 'c658294a-fac1-44c7-818e-a66bba7bad1f', 'Md. Nasir Uddin', 'nasir.std@gmail.com', NULL, '$2y$10$qLFVv6gJZ1ur6OKbLeTYBOVElVrG4EdJjXcUTjp8algyCXXTNyn1K', 'Professor', 'Math', 'Inside Science', 1234567891, 'Dattapara, Tongi, Gazipur.', 'Founder of Inside Science. 25years of experience.', 1, NULL, 'storage/ProfilePhotos/WJTQcaeE8CJKp1fiPOjGE8A2wGy7FoJHtj1wTfGM.jpg', 'gJR1Qz81G63uZ743WRLiDqqaE2rHKKnV8L6jKnnjozZwka5lnsX3gsHXVoKj', '2020-12-21 04:51:03', '2021-04-22 10:56:07'),
(3, 'f1d02ef9-5eba-46b7-8b58-ffbbc3223213', 'Md. Sohel Rana', 'sohel.rana@gmail.com', NULL, '$2y$10$0nu0XFZCQvut0sUZKQf2s.vOWLmDdrl0DvE9YGlqQKg4ds7c7ycDq', 'Lecturer', 'English', 'Birshrestho Nur Mohammad College', 1234567892, NULL, '10years of experience', 1, NULL, NULL, 'QCpOLuuFeXZIFSxNQ5VcaA5ajGKGws3ruC66AhMGLzIC5gZXZ6JNUodHhjqw', '2020-12-21 04:53:42', '2021-04-23 18:26:57');

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
(18, '2020_12_19_071601_create_response_answers_table', 1),
(19, '2020_12_22_144732_create_ratings_table', 2),
(38, '2020_12_22_170310_create_wishlists_table', 3),
(39, '2021_03_22_083057_create_discussion_panels_table', 3),
(40, '2021_03_22_084408_create_threads_table', 3),
(41, '2021_03_22_084421_create_replies_table', 3),
(42, '2021_03_22_112506_create_announcements_table', 3),
(43, '2021_04_06_214116_create_payments_table', 3),
(44, '2021_04_06_220228_create_received_payments_table', 3),
(45, '2021_04_17_190020_create_notifications_table', 3),
(46, '2021_04_17_191322_create_payment_infos_table', 3);

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
(2, 'Unity Setup', 1, '2020-12-07 08:16:16', '2020-12-22 18:37:25'),
(3, 'Unity Components', 1, '2020-12-07 08:16:22', '2020-12-07 08:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('9ab61bd3-178e-47a1-8de9-f2a15d6fe210', 'App\\Notifications\\PaymentReceived', 'App\\Student', 1, '{\"course\":\"Space Wrap with Unity\",\"amount\":\"700\"}', '2021-04-23 17:16:34', '2021-04-23 08:52:11', '2021-04-23 17:16:34'),
('a3d4f591-d923-4fea-8e58-4cc67d02a418', 'App\\Notifications\\AccountVerified', 'App\\Instructor', 3, '[]', '2021-04-23 18:06:32', '2021-04-23 18:06:28', '2021-04-23 18:06:32');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_edited` tinyint(1) NOT NULL DEFAULT 0,
  `needs_verification` tinyint(1) NOT NULL DEFAULT 1,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `course_id`, `student_id`, `method`, `account_no`, `transaction_id`, `amount`, `reference`, `is_edited`, `needs_verification`, `is_verified`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Nagad', 1998330487, 'TXRED5620', '700.00', 'Masud Rana', 0, 1, 0, '2021-04-23 08:52:03', '2021-04-23 08:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_infos`
--

CREATE TABLE `payment_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` bigint(20) UNSIGNED NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_infos`
--

INSERT INTO `payment_infos` (`id`, `course_id`, `method`, `account_no`, `account_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'BKash', 1925755171, 'Merchant', '2021-04-20 14:41:42', '2021-04-20 14:41:42'),
(4, 1, 'Rocket', 1925755171, 'Personal', '2021-04-20 14:42:23', '2021-04-20 14:52:53'),
(5, 1, 'Nagad', 1925755171, 'Merchant', '2021-04-20 14:53:37', '2021-04-20 14:53:37');

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
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `course_id`, `student_id`, `rating`, `review`, `date`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 9, 'This course is the best available so for.', '2020-12-22', '2020-12-22 10:08:14', '2020-12-22 10:26:25'),
(3, 1, 2, 10, 'This course is very beginner friendly yet offers most output.', '2020-12-22', '2020-12-22 10:33:21', '2020-12-22 10:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `received_payments`
--

CREATE TABLE `received_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_payments`
--

INSERT INTO `received_payments` (`id`, `course_id`, `method`, `account_no`, `transaction_id`, `amount`, `reference`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nagad', 1998330487, 'TXRED5620', '700.00', 'Masud Rana', '2021-04-22', '2021-04-20 15:07:00', '2021-04-22 10:44:00'),
(3, 1, 'BKash', 1925755171, 'TXRED5621', '700.00', 'Tariqul', '2021-04-13', '2021-04-20 15:17:02', '2021-04-20 15:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thread_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_solution` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `thread_id`, `student_id`, `instructor_id`, `message`, `is_solution`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Thanks!', 0, '2021-04-22 11:23:28', '2021-04-22 11:23:28'),
(2, 1, 2, NULL, 'Thanks. Much Appreciated', 0, '2021-04-22 11:25:00', '2021-04-22 11:25:00'),
(3, 2, NULL, 3, 'kudos!', 0, '2021-04-22 11:28:56', '2021-04-22 11:28:56'),
(4, 1, NULL, 3, 'Update! the problem is fixed with the latest release.', 1, '2021-04-22 11:29:30', '2021-04-22 11:30:00');

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
(3, 3, 1, 5.00, 0, '2020-12-20 09:12:36', '2021-03-19 05:18:22'),
(4, 5, 1, NULL, 0, '2020-12-20 09:12:57', '2020-12-20 09:12:57'),
(5, 1, 2, 5.00, 1, '2020-12-20 09:21:40', '2020-12-20 09:21:40'),
(6, 2, 2, 2.50, 1, '2020-12-20 09:21:46', '2020-12-20 09:21:46'),
(7, 3, 2, 4.00, 0, '2020-12-20 09:22:12', '2021-03-19 10:42:58'),
(8, 5, 2, NULL, 0, '2020-12-20 09:22:44', '2020-12-20 09:22:44'),
(9, 6, 1, NULL, 0, '2020-12-23 08:25:19', '2020-12-23 08:25:19'),
(10, 4, 1, NULL, 0, '2021-03-19 10:47:07', '2021-03-19 10:47:07');

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
(9, 8, NULL, 'storage/Space Wrap with Unity/Program.cs', '2020-12-20 09:22:44', '2020-12-20 09:22:44'),
(10, 9, 'https://unity3d.com/get-unity/download', NULL, '2020-12-23 08:25:19', '2020-12-23 08:25:19'),
(11, 10, '<p>sgdfchghj</p>', NULL, '2021-03-19 10:47:07', '2021-03-19 10:47:07');

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
(1, 'Masud Rana', 'masud@gmail.com', NULL, '$2y$10$/RwOlYsuI9q0Emo/iFNb.OOlkJ7MdmZ41aS6LqPuT3E0uhnqGJiwu', 'Undergraduate', 'DIU', 'B.Sc. in SWE', 1234567891, NULL, 'Web Development', 'storage/ProfilePhotos/DnhxNp5MKzPwn1S7nopeA2By4M7qptpLFW0Nc8gx.png', '6Tt25VMb2kj6T8GkImnxcBdsRf7ZSBrBY4bqTVzbEV9KeDn3ZMavhmxG71pk', '2020-12-20 08:29:20', '2021-04-22 11:22:55'),
(2, 'Tariqul Islam', 'tariqul@gmail.com', NULL, '$2y$10$QGx/Vk.P8Ya7hn0vhDhDvOhj7qtFw6EMCMfBgq11NgChujlzUzlWm', 'Undergraduate', 'MIU', 'B.Sc. in CSE', 1521214410, NULL, 'Game Development', NULL, 'lrP84pDICZPDBFLUByllKrEFFaEaMdtkO6QTZ5WvQbq2QjMnJ5u7JglFYtvA', '2020-12-20 09:21:04', '2020-12-20 09:21:04'),
(3, 'Nowroj Arefin', 'arefin@gmail.com', NULL, '$2y$10$2tvSTNXr6hlps.jaWBMUx.l0BZnkePUtuPbJoFsfWbZkE9AD9aJLm', 'Graduate', 'NSU', 'MBA', 1234567890, NULL, NULL, NULL, NULL, '2020-12-22 14:57:54', '2020-12-22 15:05:33');

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
(6, 'Data Science', '2020-12-21 01:19:56', '2020-12-21 01:19:56'),
(8, 'English', '2020-12-23 07:04:47', '2020-12-23 07:04:47'),
(9, 'Cyber Security', '2020-12-23 08:26:30', '2020-12-23 08:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discussion_panel_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `discussion_panel_id`, `student_id`, `instructor_id`, `subject`, `body`, `content_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 2, 'Unity Setup Problem', '<p>Don&#39;t Install the latest version of unity. There is a bug due to which the installation process fails. Install the version <strong><em>20.10.1.2 </em></strong>or any other stable version.<br />\r\nThank you.</p>', 5, '2021-04-22 10:52:11', '2021-04-22 10:52:11'),
(2, 1, NULL, 2, 'Welcome', '<p>Welcome to the course. Together we hope we will learn a lot.</p>', NULL, '2021-04-22 10:57:20', '2021-04-22 10:57:20');

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

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
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
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_course_id_foreign` (`course_id`);

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
-- Indexes for table `discussion_panels`
--
ALTER TABLE `discussion_panels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussion_panels_course_id_foreign` (`course_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_id_foreign` (`course_id`),
  ADD KEY `payments_student_id_foreign` (`student_id`);

--
-- Indexes for table `payment_infos`
--
ALTER TABLE `payment_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_infos_course_id_foreign` (`course_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_course_id_foreign` (`course_id`),
  ADD KEY `ratings_student_id_foreign` (`student_id`);

--
-- Indexes for table `received_payments`
--
ALTER TABLE `received_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `received_payments_course_id_foreign` (`course_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_student_id_foreign` (`student_id`),
  ADD KEY `replies_instructor_id_foreign` (`instructor_id`);

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
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `threads_discussion_panel_id_foreign` (`discussion_panel_id`),
  ADD KEY `threads_content_id_foreign` (`content_id`),
  ADD KEY `threads_student_id_foreign` (`student_id`),
  ADD KEY `threads_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_course_id_foreign` (`course_id`),
  ADD KEY `wishlists_student_id_foreign` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_instructor`
--
ALTER TABLE `course_instructor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `discussion_panels`
--
ALTER TABLE `discussion_panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_infos`
--
ALTER TABLE `payment_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `received_payments`
--
ALTER TABLE `received_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `response_answers`
--
ALTER TABLE `response_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `discussion_panels`
--
ALTER TABLE `discussion_panels`
  ADD CONSTRAINT `discussion_panels_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_infos`
--
ALTER TABLE `payment_infos`
  ADD CONSTRAINT `payment_infos_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `received_payments`
--
ALTER TABLE `received_payments`
  ADD CONSTRAINT `received_payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `threads_discussion_panel_id_foreign` FOREIGN KEY (`discussion_panel_id`) REFERENCES `discussion_panels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `threads_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `threads_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
